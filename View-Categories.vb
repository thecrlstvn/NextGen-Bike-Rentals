Imports MySql.Data.MySqlClient
Imports CloudinaryDotNet
Imports CloudinaryDotNet.Actions
Imports Guna.UI2.WinForms

Public Class ViewCategories

    ' Load categories data into GunaDataGridView
    Private Sub LoadCategories()
            ' MySQL connection string
            Dim conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")

            Try
                conn.Open()

                ' SQL query to retrieve data from categories table
                Dim query As String = "SELECT * FROM categories"
                Dim cmd As New MySqlCommand(query, conn)

                ' Execute the query and load data into a DataTable
                Dim adapter As New MySqlDataAdapter(cmd)
                Dim table As New DataTable()
                adapter.Fill(table)

                ' Bind the DataTable to the GunaDataGridView
                GunaDataGridView1.DataSource = table

            Catch ex As Exception
                MessageBox.Show("Error loading categories: " & ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
            Finally
                conn.Close()
            End Try
        End Sub

        ' Event handler for cell click on GunaDataGridView
        Private Sub GunaDataGridView1_CellClick(sender As Object, e As DataGridViewCellEventArgs) Handles GunaDataGridView1.CellClick
            ' Check if the clicked cell is valid
            If e.RowIndex >= 0 Then
                ' Get the current row
                Dim row As DataGridViewRow = GunaDataGridView1.Rows(e.RowIndex)

                ' Populate the fields with the values from the selected row
                txtCategoryID.Text = row.Cells("category_id").Value.ToString()
                txtCategoryName.Text = row.Cells("category_name").Value.ToString()
                txtSlug.Text = row.Cells("slug").Value.ToString()
                txtDescription.Text = row.Cells("description").Value.ToString()
                txtMetaTitle.Text = row.Cells("meta_title").Value.ToString()
                txtMetaDescription.Text = row.Cells("meta_description").Value.ToString()
                txtMetaKeywords.Text = row.Cells("meta_keywords").Value.ToString()

                ' Set the status checkbox based on the value
                chkStatus.Checked = (row.Cells("status").Value.ToString() = "1")

                ' Load the image URL if available
                If Not IsDBNull(row.Cells("image").Value) Then
                    Dim imageUrl As String = row.Cells("image").Value.ToString()
                    ShowImageInPictureBox(imageUrl)  ' Call function to load image
                Else
                Picture1.Image = Nothing  ' Clear the PictureBox if no image URL
            End If
            End If
        End Sub

        ' Function to display image in PictureBox from a Cloudinary URL
        Private Sub ShowImageInPictureBox(imageUrl As String)
            Try
                ' Load the image from the URL
                Dim request As System.Net.WebRequest = System.Net.WebRequest.Create(imageUrl)
                Using response As System.Net.WebResponse = request.GetResponse()
                    Using stream As System.IO.Stream = response.GetResponseStream()
                    Picture1.Image = Image.FromStream(stream)  ' Set the PictureBox image
                End Using
                End Using
            Catch ex As Exception
                MessageBox.Show("Failed to load image: " & ex.Message, "Image Load Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
            End Try
        End Sub

        ' CheckedChanged event for chkStatus
        Private Sub chkStatus_CheckedChanged(sender As Object, e As EventArgs) Handles chkStatus.CheckedChanged
            If chkStatus.Checked Then
                MessageBox.Show("Category status set to Active", "Status Update", MessageBoxButtons.OK, MessageBoxIcon.Information)
            Else
                MessageBox.Show("Category status set to Inactive", "Status Update", MessageBoxButtons.OK, MessageBoxIcon.Information)
            End If
        End Sub

        ' Button click event to update category
        Private Sub btnUpdateCategory_Click(sender As Object, e As EventArgs) Handles btnUpdateCategory.Click
            ' MySQL connection string
            Dim conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
            conn.Open()

            Try
                ' SQL query to update the category
                Dim query As String = "UPDATE categories SET category_name=@category_name, slug=@slug, description=@description, meta_title=@meta_title, meta_description=@meta_description, meta_keywords=@meta_keywords, status=@status, image=@image WHERE category_id=@category_id"

                ' MySQL command
                Dim cmd As New MySqlCommand(query, conn)

                ' Bind parameters from Guna2TextBoxes or other input controls
                cmd.Parameters.AddWithValue("@category_name", txtCategoryName.Text)
                cmd.Parameters.AddWithValue("@slug", txtSlug.Text)
                cmd.Parameters.AddWithValue("@description", txtDescription.Text)
                cmd.Parameters.AddWithValue("@meta_title", txtMetaTitle.Text)
                cmd.Parameters.AddWithValue("@meta_description", txtMetaDescription.Text)
                cmd.Parameters.AddWithValue("@meta_keywords", txtMetaKeywords.Text)
                cmd.Parameters.AddWithValue("@status", If(chkStatus.Checked, 1, 0)) ' Assuming Guna2CheckBox for status

                ' Image upload logic
                Dim update_filename As String = ""

                ' Open File Dialog to select the new image
                Using openFileDialog As New OpenFileDialog()
                    openFileDialog.Filter = "Image Files|*.jpg;*.jpeg;*.png;*.gif|All Files|*.*"

                    ' If user selects an image file
                    If openFileDialog.ShowDialog() = DialogResult.OK Then
                        Dim selectedImagePath As String = openFileDialog.FileName

                        ' Upload the selected image to Cloudinary
                        Dim cloudinary As New Cloudinary(New Account("your_cloud_name", "your_api_key", "your_api_secret"))
                        Dim uploadParams As New ImageUploadParams() With {
                        .File = New FileDescription(selectedImagePath)
                    }
                        Dim uploadResult As ImageUploadResult = cloudinary.Upload(uploadParams)

                        ' Get the secure URL of the uploaded image
                        update_filename = uploadResult.SecureUrl.ToString()
                    End If
                End Using

                ' Add the image filename to the query
                cmd.Parameters.AddWithValue("@image", update_filename)

                ' Add category_id for the WHERE clause
                cmd.Parameters.AddWithValue("@category_id", txtCategoryID.Text)

                ' Execute the query
                cmd.ExecuteNonQuery()
                MessageBox.Show("Category Updated Successfully", "Success", MessageBoxButtons.OK, MessageBoxIcon.Information)
            Catch ex As Exception
                ' Show error message if update fails
                MessageBox.Show("Error: " & ex.Message, "Update Failed", MessageBoxButtons.OK, MessageBoxIcon.Error)
            Finally
                ' Ensure the connection is closed
                conn.Close()
            End Try
        End Sub

    ' Call LoadCategories when the form loads or needs to refresh
    Private Sub YourForm_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadCategories()
    End Sub

    Private Sub AddNewCategories_Click(sender As Object, e As EventArgs) Handles AddNewCategories.Click
        Dim addCategoryForm As New AddNewCategories()
        addCategoryForm.Show()
        Me.Hide()
    End Sub

    Private Sub backbutton_Click(sender As Object, e As EventArgs) Handles backbutton.Click
        AdminBikes.Show()
        Me.Hide()
    End Sub
End Class
