Imports System.Data
Imports System.Drawing
Imports System.IO
Imports System.Net
Imports CloudinaryDotNet
Imports CloudinaryDotNet.Actions
Imports MySql.Data.MySqlClient


Public Class AdminBikes

    Private Sub PictureBox10_Click(sender As Object, e As EventArgs) Handles PictureBox10.Click
        Application.Exit()
    End Sub

    Private Sub PbDash_Click(sender As Object, e As EventArgs) Handles pbDash.Click
        AdminDash.Show()
        Me.Hide()
    End Sub

    Private Sub PbUsers_Click(sender As Object, e As EventArgs) Handles pbUsers.Click
        AdminUsers.Show()
        Me.Hide()
    End Sub
    Private Sub PbReports_Click(sender As Object, e As EventArgs)
        AdminReports.Show()
        Me.Hide()
    End Sub

    Private Sub PbSales_Click(sender As Object, e As EventArgs) Handles pbSales.Click
        AdminSales.Show()
        Me.Hide()
    End Sub

    Private Sub PbBookings_Click(sender As Object, e As EventArgs) Handles pbBookings.Click
        AdminBookings.Show()

    End Sub

    Private Sub PbReviews_Click(sender As Object, e As EventArgs) Handles pbReviews.Click
        AdminReviews.Show()
        Me.Hide()
    End Sub
    Private Sub AddNewBikes_Click(sender As Object, e As EventArgs) Handles AddNewBikes.Click
        Dim AddNewBikes As New AddNewBikes()
        AddNewBikes.Show()
        Me.Hide()
    End Sub

    Private Sub AddNewCategories_Click(sender As Object, e As EventArgs) 
        Dim addCategoryForm As New AddNewCategories()
        addCategoryForm.Show()
        Me.Hide()
    End Sub

        Private Cloudinary As Cloudinary

        Public Sub New()
            InitializeComponent()

        ' Initialize Cloudinary
        Dim account As New Account("dsyt4e4fp", "399586786843443", "HH4mh7xMDej9XRNY06BPrgAEn6M")
        Cloudinary = New Cloudinary(account)
        End Sub

        ' Load bikes into the DataGridView
        Sub LoadData()
            Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                Using cmd As New MySqlCommand("SELECT * FROM bikes", conn)
                    Using adapter As New MySqlDataAdapter(cmd)
                        Using table As New DataTable()
                            Try
                                conn.Open()
                                adapter.Fill(table)
                                Guna2DataGridView2.DataSource = table
                                ApplyStyling() ' Apply styling after loading data
                            Catch ex As Exception
                                MessageBox.Show(ex.Message)
                            Finally
                                conn.Close()
                            End Try
                        End Using
                    End Using
                End Using
            End Using
        End Sub

        ' Function to apply DataGridView styling
        Sub ApplyStyling()
            With Guna2DataGridView2
                .ColumnHeadersDefaultCellStyle.BackColor = Color.FromArgb(100, 88, 255)
                .ColumnHeadersDefaultCellStyle.ForeColor = Color.White
                .ColumnHeadersDefaultCellStyle.Font = New Font("Segoe UI", 10, FontStyle.Bold)
                .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
                .ColumnHeadersHeight = 40
                .ColumnHeadersBorderStyle = DataGridViewHeaderBorderStyle.None
                .CellBorderStyle = DataGridViewCellBorderStyle.SingleHorizontal
                .GridColor = Color.FromArgb(231, 229, 255)
                .DefaultCellStyle.BackColor = Color.White
                .DefaultCellStyle.ForeColor = Color.Black
                .DefaultCellStyle.SelectionBackColor = Color.FromArgb(231, 229, 255)
                .DefaultCellStyle.SelectionForeColor = Color.FromArgb(71, 69, 94)
                .RowTemplate.Height = 30
            End With
        End Sub

        ' Load event for the form
        Private Sub AdminBike_Load(sender As Object, e As EventArgs) Handles MyBase.Load
            LoadBikes() ' Load bikes when the form loads
            LoadCategories()
            LoadAvailabilityStatus() ' Load availability status options
            AddHandler Guna2DataGridView2.CellClick, AddressOf DgvBikes_CellClick ' Register the CellClick event handler
        End Sub

        ' Load bikes from the database and display them in the Guna2DataGridView
        Private Sub LoadBikes()
            Try
                Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                    Dim cmd As New MySqlCommand("SELECT * FROM bikes", conn)
                    Dim adapter As New MySqlDataAdapter(cmd)
                    Dim dt As New DataTable()

                    conn.Open()
                    adapter.Fill(dt)

                    Guna2DataGridView2.DataSource = dt
                End Using
            Catch ex As MySqlException
                MessageBox.Show("Error loading bikes: " & ex.Message)
            End Try
        End Sub

        ' SQL call for updating a bike
        Private Shared Function SqlCall() As String
            Return "UPDATE bikes SET category_id=@category_id, bike_name=@bike_name, slug=@slug, bike_brand=@bike_brand, bike_size=@bike_size, description=@description, hourly_rate=@hourly_rate, daily_rate=@daily_rate, image=@image, qty=@qty, availability_status=@availability_status, trending=@trending, meta_title=@meta_title, meta_keywords=@meta_keywords, meta_description=@meta_description, updated_at=NOW() WHERE bikeid=@bikeid"
        End Function

        ' SQL call for deleting a bike
        Private Shared Function DeleteSqlCall() As String
            Return "DELETE FROM bikes WHERE bikeid=@bikeid"
        End Function

        ' Load bike categories into the ComboBox
        Private Sub LoadCategories()
            Try
                Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                    Dim cmd As New MySqlCommand("SELECT category_id, category_name FROM categories", conn)
                    Dim adapter As New MySqlDataAdapter(cmd)
                    Dim dt As New DataTable()

                    conn.Open()
                    adapter.Fill(dt)

                    combCategory.DataSource = dt
                    combCategory.DisplayMember = "category_name"
                    combCategory.ValueMember = "category_id"
                End Using
            Catch ex As MySqlException
                MessageBox.Show("Error loading categories: " & ex.Message)
            End Try
        End Sub

        ' Load availability statuses into the ComboBox
        Private Sub LoadAvailabilityStatus()
            combAvailability.Items.Clear()
            combAvailability.Items.Add("Available")
            combAvailability.Items.Add("Not Available")
            combAvailability.Items.Add("Under Maintenance")
        End Sub
    Private Sub DgvBikes_CellClick(sender As Object, e As DataGridViewCellEventArgs) Handles Guna2DataGridView2.CellClick
        If e.RowIndex >= 0 Then
            Dim row As DataGridViewRow = Guna2DataGridView2.Rows(e.RowIndex)

            ' Populate fields with selected row data
            textBikeName.Text = If(row.Cells("bike_name").Value?.ToString(), String.Empty)
            textSlug.Text = If(row.Cells("slug").Value?.ToString(), String.Empty)
            textBikeBrand.Text = If(row.Cells("bike_brand").Value?.ToString(), String.Empty)
            textBikeSize.Text = If(row.Cells("bike_size").Value?.ToString(), String.Empty)
            textBikeDescription.Text = If(row.Cells("description").Value?.ToString(), String.Empty)
            textHourlyRate.Text = If(row.Cells("hourly_rate").Value?.ToString(), String.Empty)
            textDailyRate.Text = If(row.Cells("daily_rate").Value?.ToString(), String.Empty)

            ' Handle DBNull for qty
            If IsDBNull(row.Cells("qty").Value) Then
                numQuantity.Value = 0
            Else
                numQuantity.Value = Convert.ToDecimal(row.Cells("qty").Value)
            End If

            ' Set the selected availability status
            Dim availability As String = If(row.Cells("availability_status").Value?.ToString(), String.Empty)
            If combAvailability.Items.Contains(availability) Then
                combAvailability.SelectedItem = availability
            End If

            ' Show the image in the PictureBox and file name in the TextBox
            imagebox.Text = If(row.Cells("image").Value?.ToString(), String.Empty)
            ShowImagePreview(imagebox.Text)

            ' Set category ComboBox selection based on category_id in the selected row
            If Not IsDBNull(row.Cells("category_id").Value) Then
                combCategory.SelectedValue = Convert.ToInt32(row.Cells("category_id").Value)
            End If
        End If
    End Sub


    ' Show image preview in the PictureBox
    Private Sub ShowImagePreview(imagePath As String)
            If Not String.IsNullOrEmpty(imagePath) Then
                If Uri.IsWellFormedUriString(imagePath, UriKind.Absolute) Then
                    Try
                        ' Load image from Cloudinary URL
                        Dim request As WebRequest = WebRequest.Create(imagePath)
                        Using response As WebResponse = request.GetResponse()
                            Using stream As Stream = response.GetResponseStream()
                                imagebox.Image = Image.FromStream(stream)
                            End Using
                        End Using
                    Catch ex As Exception
                        MessageBox.Show("Error loading image from URL: " & ex.Message)
                        imagebox.Image = Nothing
                    End Try
                Else
                    MessageBox.Show("Invalid image URL: " & imagePath)
                    imagebox.Image = Nothing
                End If
            End If
        End Sub

    ' Variable to store the public ID of the previous image
    Private previousImagePublicId As String = String.Empty
    Private isImageUploaded As Boolean = False

    ' Event handler for selecting an image using the Choose File button
    Private Sub btnChooseFile_Click(sender As Object, e As EventArgs) Handles btnChooseFile.Click
        Dim openFileDialog As New OpenFileDialog()
        openFileDialog.Filter = "Image Files|*.jpg;*.jpeg;*.png|All Files|*.*"

        If openFileDialog.ShowDialog() = DialogResult.OK Then
            ' Set the TextBox to the selected file name
            imagebox.Text = openFileDialog.FileName

            ' Show the image preview in the PictureBox
            ShowImagePreview(imagebox.Text)

            ' If an image has been previously uploaded, delete it
            If Not String.IsNullOrEmpty(previousImagePublicId) Then
                DeleteImageFromCloudinary(previousImagePublicId)
            End If

            ' Upload the selected image to Cloudinary and get the URL
            Dim imageUrl As String = UploadImageToCloudinary(imagebox.Text)

            ' If upload is successful, store the URL and public ID for the image link
            If Not String.IsNullOrEmpty(imageUrl) Then
                txtImageFileName.Text = imageUrl
                previousImagePublicId = GetPublicIdFromUrl(imageUrl) ' Extract the public ID from the URL
                isImageUploaded = True ' Set flag to true to indicate an image is uploaded
            Else
                MessageBox.Show("Image upload failed. Please try again.")
            End If
        End If
    End Sub

    ' Function to delete an image from Cloudinary using its public ID
    Private Sub DeleteImageFromCloudinary(publicId As String)
        Try
            Dim deleteParams As New DeletionParams(publicId)
            Dim deletionResult As DeletionResult = Cloudinary.Destroy(deleteParams)

            If deletionResult.StatusCode = HttpStatusCode.OK Then
                MessageBox.Show("Previous image deleted successfully.")
            Else
                MessageBox.Show($"Failed to delete previous image. Status: {deletionResult.StatusCode}. Message: {deletionResult.Error?.Message}")
            End If
        Catch ex As Exception
            MessageBox.Show($"Error deleting image from Cloudinary: {ex.Message}")
        End Try
    End Sub

    ' Function to extract the public ID from the Cloudinary URL
    Private Function GetPublicIdFromUrl(imageUrl As String) As String
        Dim uri As New Uri(imageUrl)
        Dim segments As String() = uri.Segments
        ' Cloudinary URLs typically have the format: https://res.cloudinary.com/<cloud_name>/image/upload/v<version>/<public_id>.<format>
        If segments.Length > 2 Then
            Dim publicIdSegment As String = segments(segments.Length - 1) ' Get the last segment
            Return publicIdSegment.Substring(0, publicIdSegment.LastIndexOf(".")) ' Remove file extension
        End If
        Return String.Empty
    End Function

    ' Function to upload the selected image to Cloudinary
    Private Function UploadImageToCloudinary(filePath As String) As String
        Try
            Dim uploadParams As New ImageUploadParams() With {
            .File = New FileDescription(filePath),
            .Folder = "products" ' Specify your Cloudinary folder
        }

            ' Ensure Cloudinary is initialized before use
            If Cloudinary IsNot Nothing Then
                Dim uploadResult As ImageUploadResult = Cloudinary.Upload(uploadParams)

                ' Check if the upload was successful and return the URL
                If uploadResult IsNot Nothing AndAlso uploadResult.StatusCode = HttpStatusCode.OK Then
                    Return uploadResult.SecureUrl.ToString() ' Use SecureUrl for HTTPS links
                Else
                    ' More detailed error reporting
                    MessageBox.Show($"Upload failed with status: {uploadResult.StatusCode}. Message: {uploadResult.Error?.Message}")
                    Return String.Empty
                End If
            Else
                MessageBox.Show("Cloudinary instance is not initialized.")
                Return String.Empty
            End If
        Catch ex As Exception
            MessageBox.Show($"Error uploading image to Cloudinary: {ex.Message}")
            Return String.Empty
        End Try
    End Function


    ' Event handler for the Update button
    Private Sub btnUpdate_Click(sender As Object, e As EventArgs) Handles btnUpdate.Click
            Dim bikeId As Integer = Convert.ToInt32(Guna2DataGridView2.CurrentRow.Cells("bikeid").Value)
            Dim imageUrl As String = UploadImageToCloudinary(imagebox.Text)

            Try
                Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                    Using cmd As New MySqlCommand(SqlCall(), conn)
                        cmd.Parameters.AddWithValue("@category_id", combCategory.SelectedValue)
                        cmd.Parameters.AddWithValue("@bike_name", textBikeName.Text)
                        cmd.Parameters.AddWithValue("@slug", textSlug.Text)
                        cmd.Parameters.AddWithValue("@bike_brand", textBikeBrand.Text)
                        cmd.Parameters.AddWithValue("@bike_size", textBikeSize.Text)
                        cmd.Parameters.AddWithValue("@description", textBikeDescription.Text)
                        cmd.Parameters.AddWithValue("@hourly_rate", Convert.ToDecimal(textHourlyRate.Text))
                        cmd.Parameters.AddWithValue("@daily_rate", Convert.ToDecimal(textDailyRate.Text))
                        cmd.Parameters.AddWithValue("@image", imageUrl)
                        cmd.Parameters.AddWithValue("@qty", Convert.ToInt32(numQuantity.Value))
                        cmd.Parameters.AddWithValue("@availability_status", combAvailability.SelectedItem)
                        cmd.Parameters.AddWithValue("@trending", 0) ' Set as needed
                        cmd.Parameters.AddWithValue("@meta_title", String.Empty) ' Set as needed
                        cmd.Parameters.AddWithValue("@meta_keywords", String.Empty) ' Set as needed
                        cmd.Parameters.AddWithValue("@meta_description", String.Empty) ' Set as needed
                        cmd.Parameters.AddWithValue("@bikeid", bikeId)

                        conn.Open()
                        cmd.ExecuteNonQuery()
                        MessageBox.Show("Bike updated successfully!")
                    End Using
                End Using
                LoadBikes() ' Refresh the DataGridView
            Catch ex As MySqlException
                MessageBox.Show("Error updating bike: " & ex.Message)
            End Try
        End Sub

    ' Event handler for the Delete button
    Private Sub btnDeleteClick(sender As Object, e As EventArgs) Handles btnDelete.Click
        If MessageBox.Show("Are you sure you want to delete this bike?", "Confirm Delete", MessageBoxButtons.YesNo) = DialogResult.Yes Then
            Dim bikeId As Integer = Convert.ToInt32(Guna2DataGridView2.CurrentRow.Cells("bikeid").Value)

            Try
                Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                    Using cmd As New MySqlCommand(DeleteSqlCall(), conn)
                        cmd.Parameters.AddWithValue("@bikeid", bikeId)
                        conn.Open()
                        cmd.ExecuteNonQuery()
                        MessageBox.Show("Bike deleted successfully!")
                    End Using
                End Using
                LoadBikes() ' Refresh the DataGridView
            Catch ex As MySqlException
                MessageBox.Show("Error deleting bike: " & ex.Message)
            End Try
        End If
    End Sub

    ' Handle the Delete button click
    Private Sub BtnDelete_Click(sender As Object, e As EventArgs) Handles btnDelete.Click
        If Guna2DataGridView2.SelectedRows.Count = 0 Then
            MessageBox.Show("Please select a bike to delete.")
            Return
        End If

        Try
            ' Delete the selected bike record from the database
            Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                conn.Open()
                Using cmd As New MySqlCommand("DELETE FROM bikes WHERE bikeid = @bikeid", conn)
                    cmd.Parameters.AddWithValue("@bikeid", Guna2DataGridView2.SelectedRows(0).Cells("bikeid").Value)

                    cmd.ExecuteNonQuery()
                End Using
            End Using

            MessageBox.Show("Bike deleted successfully!")
            LoadBikes() ' Reload the updated bikes data
        Catch ex As MySqlException
            MessageBox.Show("Error deleting bike: " & ex.Message)
        End Try
    End Sub

    Private Sub Logoutbike_Click(sender As Object, e As EventArgs) Handles logoutbike.Click
        Dim result As DialogResult = MessageBox.Show("Are you sure you want to log out?", "Log Out", MessageBoxButtons.YesNo)
        If result = DialogResult.Yes Then
            ' Show the login form and hide the admin dashboard
            Login.Show()
            Me.Hide()
        End If
    End Sub

    Private Sub Button_Click(sender As Object, e As EventArgs) Handles btnCategories.Click
        ViewCategories.Show()
        Me.Hide()
    End Sub

End Class