Imports Microsoft.SqlServer
Imports MySql.Data.MySqlClient
Imports Org.BouncyCastle.Asn1.Cmp

Public Class AddNewCategories
    Private Sub backbutton2_Click(sender As Object, e As EventArgs) Handles backbutton2.Click
        ViewCategories.Show()
        Me.Hide()
    End Sub
    Private Sub BtnSelectImageGuna_Click(sender As Object, e As EventArgs) Handles btnSelectImage1.Click
        Using ofd As New OpenFileDialog()
            ofd.Filter = "Image Files|*.jpg;*.jpeg;*.png;*.gif;*.bmp"

            If ofd.ShowDialog() = DialogResult.OK Then
                ' Get the original file path and file name from the dialog
                Dim selectedImagePath As String = ofd.FileName
                Dim originalFileName As String = System.IO.Path.GetFileName(selectedImagePath)

                ' Display the file name in the TextBox
                txtImageFileName1.Text = originalFileName

                ' Define the path where you want to save the image
                Dim destinationFolder As String = $"{Application.StartupPath}\nextgen\"

                ' Ensure the folder exists, if not create it
                If Not System.IO.Directory.Exists(destinationFolder) Then
                    System.IO.Directory.CreateDirectory(destinationFolder)
                End If

                ' Define the destination path including the original file name
                Dim destinationPath As String = destinationFolder & originalFileName

                ' Copy the selected image to the destination folder with the original file name
                System.IO.File.Copy(selectedImagePath, destinationPath, True)

                ' Optional: You can store the relative path with the original file name in the database
                ' For example, store it like "\nextgen\originalFileName.jpg"
            End If
        End Using
    End Sub
    Private Sub btnAddCategory_Click(sender As Object, e As EventArgs) Handles btncategory.Click
        ' Collect values from the TextBoxes
        Dim categoryName As String = txtCategoryName.Text
        Dim slug As String = txtSlug2.Text
        Dim description As String = txtDescription.Text
        Dim image As String = txtImageFileName1.Text ' Corrected to use the image file name from the TextBox
        Dim metaTitle As String = txtMetaTitle.Text
        Dim metaDescription As String = txtMetaDescription.Text
        Dim metaKeywords As String = txtMetaKeywords.Text
        Dim createdAt As DateTime = DateTime.Now ' Automatically setting created_at
        Dim status As Integer = 0 ' Default value for status

        ' Insert Query with status defaulting to 0
        Dim query As String = "INSERT INTO categories (category_name, slug, description, status, image, meta_title, meta_description, meta_keywords, created_at) " &
                          "VALUES (@category_name, @slug, @description, @status, @image, @meta_title, @meta_description, @meta_keywords, @created_at)"

        ' Connection and command setup
        Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
            Using cmd As New MySqlCommand(query, conn)
                ' Add parameters
                cmd.Parameters.AddWithValue("@category_name", categoryName)
                cmd.Parameters.AddWithValue("@slug", slug)
                cmd.Parameters.AddWithValue("@description", description)
                cmd.Parameters.AddWithValue("@status", status) ' Automatically set status to 0
                cmd.Parameters.AddWithValue("@image", image) ' Use the correct image file name
                cmd.Parameters.AddWithValue("@meta_title", metaTitle)
                cmd.Parameters.AddWithValue("@meta_description", metaDescription)
                cmd.Parameters.AddWithValue("@meta_keywords", metaKeywords)
                cmd.Parameters.AddWithValue("@created_at", createdAt)

                ' Open connection and execute query
                conn.Open()
                cmd.ExecuteNonQuery()
                MessageBox.Show("Category added successfully!")
            End Using
        End Using
    End Sub

End Class