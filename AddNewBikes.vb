Imports CloudinaryDotNet
Imports CloudinaryDotNet.Actions
Imports Microsoft.SqlServer
Imports MySql.Data.MySqlClient

Public Class AddNewBikes

    Private Cloudinary As Cloudinary

    Public Sub New()
            InitializeComponent()

            ' Initialize Cloudinary with your credentials
            Dim account As New Account("dsyt4e4fp", "399586786843443", "HH4mh7xMDej9XRNY06BPrgAEn6M")
        Cloudinary = New Cloudinary(account)

        LoadCategories() ' Load categories when the form loads

            ' Explicitly bind the BtnSave_Click event to the Save button
            AddHandler btnSave.Click, AddressOf BtnSave_Click
        End Sub

        ' Load categories into the ComboBox from the database
        Private Sub LoadCategories()
            Try
                Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                    Dim cmd As New MySqlCommand("SELECT category_id, category_name FROM categories", conn)
                    Dim adapter As New MySqlDataAdapter(cmd)
                    Dim dt As New DataTable()

                    conn.Open()
                    adapter.Fill(dt)

                    If dt.Rows.Count > 0 Then
                        cmbCategory.DataSource = dt
                        cmbCategory.DisplayMember = "category_name" ' The column to display in the ComboBox
                        cmbCategory.ValueMember = "category_id" ' The underlying value to be used
                    Else
                        MessageBox.Show("No categories found.")
                    End If
                End Using
            Catch ex As MySqlException
                MessageBox.Show("Error loading categories: " & ex.Message)
            End Try
        End Sub

        ' Function to upload image to Cloudinary
        Private Function UploadImageToCloudinary(filePath As String) As String
            Try
                Dim uploadParams As New ImageUploadParams() With {
                .File = New FileDescription(filePath),
                .Folder = "products" ' Specify your Cloudinary folder
            }

                ' Check if Cloudinary instance is initialized
                If cloudinary IsNot Nothing Then
                    Dim uploadResult As ImageUploadResult = cloudinary.Upload(uploadParams)

                    ' Check if the upload was successful and return the URL
                    If Not String.IsNullOrEmpty(uploadResult.Url.ToString()) Then
                        Return uploadResult.Url.ToString()
                    Else
                        MessageBox.Show("Upload did not return a valid URL.")
                        Return String.Empty
                    End If
                Else
                    MessageBox.Show("Cloudinary instance is not initialized.")
                    Return String.Empty
                End If
            Catch ex As Exception
                MessageBox.Show("Error uploading image to Cloudinary: " & ex.Message)
                Return String.Empty
            End Try
        End Function

        ' Event handler for selecting an image
        Private Sub BtnSelectImageGuna_Click(sender As Object, e As EventArgs) Handles btnSelectImage.Click
            Using ofd As New OpenFileDialog()
                ofd.Filter = "Image Files|*.jpg;*.jpeg;*.png;*.gif;*.bmp"

                If ofd.ShowDialog() = DialogResult.OK Then
                    Dim selectedImagePath As String = ofd.FileName
                    txtImageFileName.Text = System.IO.Path.GetFileName(selectedImagePath)

                    ' Upload the selected image to Cloudinary and get the URL
                    Dim imageUrl As String = UploadImageToCloudinary(selectedImagePath)

                    ' Store the URL in the TextBox for the image link
                    txtImageFileName.Text = imageUrl
                End If
            End Using
        End Sub
    ' Event handler for saving bike details
    Private Sub BtnSave_Click(sender As Object, e As EventArgs)
        ' Check required fields before proceeding
        If String.IsNullOrWhiteSpace(txtBikeName.Text) Then
            MessageBox.Show("Please enter the bike name.")
            txtBikeName.Focus()
            Return
        End If
        If String.IsNullOrWhiteSpace(txtSlug1.Text) Then
            MessageBox.Show("Please enter the slug.")
            txtSlug1.Focus()
            Return
        End If
        If String.IsNullOrWhiteSpace(txtBikeBrand.Text) Then
            MessageBox.Show("Please enter the bike brand.")
            txtBikeBrand.Focus()
            Return
        End If
        If String.IsNullOrWhiteSpace(txtBikeSize.Text) Then
            MessageBox.Show("Please enter the bike size.")
            txtBikeSize.Focus()
            Return
        End If
        If String.IsNullOrWhiteSpace(txtMetaDescription.Text) Then
            MessageBox.Show("Please enter a description.")
            txtMetaDescription.Focus()
            Return
        End If
        If String.IsNullOrWhiteSpace(txtHourlyRate.Text) Then
            MessageBox.Show("Please enter the hourly rate.")
            txtHourlyRate.Focus()
            Return
        End If
        If String.IsNullOrWhiteSpace(txtDailyRate.Text) Then
            MessageBox.Show("Please enter the daily rate.")
            txtDailyRate.Focus()
            Return
        End If
        If String.IsNullOrWhiteSpace(txtImageFileName.Text) OrElse txtImageFileName.Text = "No Image Selected" Then
            MessageBox.Show("Please select an image file.")
            btnSelectImage.Focus()
            Return
        End If

        ' Get availability status from ComboBox
        Dim availabilityStatus As String = cmbAvailabilityStatus.SelectedItem.ToString()

        ' Get status based on checkboxes
        Dim status As String
        If chkAvailable.Checked Then
            status = "Available"
        ElseIf chkHidden.Checked Then
            status = "Hidden"
        Else
            status = "Not Specified" ' Or leave blank if no status selected
        End If

        ' Proceed with database insert if all required fields are filled
        Dim conn As MySqlConnection = Nothing
        Try
            conn = New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
            conn.Open()

            ' SQL query for inserting data
            Dim query As String = "INSERT INTO bikes (category_id, bike_name, slug, bike_brand, bike_size, description, hourly_rate, daily_rate, image, qty, availability_status, status, trending, meta_title, meta_keywords, meta_description, created_at, updated_at) " &
                              "VALUES (@category_id, @bike_name, @slug, @bike_brand, @bike_size, @description, @hourly_rate, @daily_rate, @image, @qty, @availability_status, @status, @trending, @meta_title, @meta_keywords, @meta_description, NOW(), NOW())"

            Dim cmd As New MySqlCommand(query, conn)

            ' Assign values from the ComboBox and TextBoxes
            cmd.Parameters.AddWithValue("@category_id", cmbCategory.SelectedValue)
            cmd.Parameters.AddWithValue("@bike_name", txtBikeName.Text)
            cmd.Parameters.AddWithValue("@slug", txtSlug1.Text)
            cmd.Parameters.AddWithValue("@bike_brand", txtBikeBrand.Text)
            cmd.Parameters.AddWithValue("@bike_size", txtBikeSize.Text)
            cmd.Parameters.AddWithValue("@description", txtMetaDescription.Text)
            cmd.Parameters.AddWithValue("@hourly_rate", txtHourlyRate.Text)
            cmd.Parameters.AddWithValue("@daily_rate", txtDailyRate.Text)
            cmd.Parameters.AddWithValue("@image", txtImageFileName.Text)
            cmd.Parameters.AddWithValue("@qty", numQuantity.Value)
            cmd.Parameters.AddWithValue("@availability_status", availabilityStatus)
            cmd.Parameters.AddWithValue("@status", status)
            cmd.Parameters.AddWithValue("@trending", False)
            cmd.Parameters.AddWithValue("@meta_title", txtMetaTitle.Text)
            cmd.Parameters.AddWithValue("@meta_keywords", txtMetaKeywords.Text)
            cmd.Parameters.AddWithValue("@meta_description", txtMetaDescription.Text)

            ' Execute the command
            cmd.ExecuteNonQuery()
            MessageBox.Show("Bike details added successfully!")

        Catch ex As MySqlException
            MessageBox.Show("Error: " & ex.Message)
        Finally
            If conn IsNot Nothing Then conn.Close()
        End Try
    End Sub

    ' Event handler for chkAvailable checkbox
    Private Sub chkAvailable_CheckedChanged(sender As Object, e As EventArgs) Handles chkAvailable.CheckedChanged
        If chkAvailable.Checked Then
            chkHidden.Checked = False ' Automatically uncheck chkHidden if chkAvailable is checked
        End If
    End Sub

    ' Event handler for chkHidden checkbox
    Private Sub chkHidden_CheckedChanged(sender As Object, e As EventArgs) Handles chkHidden.CheckedChanged
        If chkHidden.Checked Then
            chkAvailable.Checked = False ' Automatically uncheck chkAvailable if chkHidden is checked
        End If
    End Sub



    ' Button to go back to the previous form
    Private Sub Backbutton_Click(sender As Object, e As EventArgs) Handles backbutton.Click
        AdminBikes.Show()
        Me.Hide()
    End Sub

End Class
