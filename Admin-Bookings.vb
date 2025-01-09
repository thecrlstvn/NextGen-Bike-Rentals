Imports MySql.Data.MySqlClient
Imports Guna.UI2.WinForms
Public Class AdminBookings
    Private Sub Admin_Bookings_Load(sender As Object, e As EventArgs) Handles MyBase.Load

    End Sub

    Private Sub PictureBox10_Click(sender As Object, e As EventArgs) Handles PictureBox10.Click
        Application.Exit()
    End Sub

    Private Sub pbDash_Click(sender As Object, e As EventArgs) Handles pbDash.Click
        AdminDash.Show()
        Me.Hide()
    End Sub

    Private Sub pbBikes_Click(sender As Object, e As EventArgs) Handles pbBikes.Click
        AdminBikes.Show()
        Me.Hide()
    End Sub

    Private Sub pbUsers_Click(sender As Object, e As EventArgs) Handles pbUsers.Click
        AdminUsers.Show()
        Me.Hide()
    End Sub

    Private Sub pbReports_Click(sender As Object, e As EventArgs) Handles pbReports.Click
        AdminReports.Show()
        Me.Hide()

    End Sub

    Private Sub pbSales_Click(sender As Object, e As EventArgs) Handles pbSales.Click
        AdminSales.Show()
        Me.Hide()
    End Sub

    Private Sub pbReviews_Click(sender As Object, e As EventArgs) Handles pbReviews.Click
        AdminReviews.Show()
        Me.Hide()
    End Sub
    Private Sub Logoutbookings_Click(sender As Object, e As EventArgs) Handles logoutbookings.Click
        Dim result As DialogResult = MessageBox.Show("Are you sure you want to log out?", "Log Out", MessageBoxButtons.YesNo)
        If result = DialogResult.Yes Then
            ' Show the login form and hide the admin dashboard
            Login.Show()
            Me.Hide()
        End If
    End Sub

    ' Connection string to connect to your MySQL database
    Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"

        ' This event triggers when the form loads
        Private Sub AdminBookings_Load(sender As Object, e As EventArgs) Handles MyBase.Load
            ' Automatically load booking data when the form loads
            LoadBookingData()
        End Sub

        Private Sub LoadBookingData()
            ' Establish connection to the database
            Using connection As New MySqlConnection(connectionString)
                Try
                    connection.Open()

                ' Query to retrieve booking data from table
                Dim query As String = "SELECT booking_id,
                bikeid,
                IFNULL(booking_date, '0000-00-00') AS booking_date,
                IFNULL(pickup_time, '00:00:00') AS pickup_time,
                IFNULL(return_time, '00:00:00') AS return_time,
                quantity,
                rate_type,
                status,
                bike_size,
                customer_name,
                customer_email,
                IFNULL(updated_at, '0000-00-00') AS updated_at,
                user_id FROM bookings"


                ' MySQL command to execute query
                Dim command As New MySqlCommand(query, connection)

                    ' MySQL data adapter to fill dataset
                    Dim adapter As New MySqlDataAdapter(command)

                    ' DataTable to hold the booking data
                    Dim table As New DataTable()

                    ' Fill the DataTable with the data from the database
                    adapter.Fill(table)

                ' Bind the DataTable to a DataGridView for display
                GunaDataGridView1.DataSource = table

                ' Customize the header text
                With GunaDataGridView1
                    .Columns(0).HeaderText = "Booking ID"
                    .Columns(1).HeaderText = "Bike ID"
                    .Columns(2).HeaderText = "Booking Date"
                    .Columns(3).HeaderText = "Pickup Time"
                    .Columns(4).HeaderText = "Return Time"
                    .Columns(5).HeaderText = "Quantity"
                    .Columns(6).HeaderText = "Rate Type"
                    .Columns(7).HeaderText = "Status"
                    .Columns(8).HeaderText = "Bike Size"
                    .Columns(9).HeaderText = "Customer Name"
                    .Columns(10).HeaderText = "Customer Email"
                    .Columns(11).HeaderText = "Updated At"
                    .Columns(12).HeaderText = "User ID"
                End With

                ' Apply styling after loading data
                ApplyStyling()

                Catch ex As Exception
                    MessageBox.Show("Error: " & ex.Message)
                End Try
            End Using
        End Sub

        ' Function to apply DataGridView styling
        Sub ApplyStyling()
            With GunaDataGridView1
                ' Apply styling to the DataGridView
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
    Private Sub btnView_Click(sender As Object, e As EventArgs) Handles btnView.Click
        ' You can either reuse the GunaDataGridView1_CellClick event or call it directly
        Dim selectedRow As DataGridViewRow = GunaDataGridView1.CurrentRow
        If selectedRow IsNot Nothing Then
            ' Display the details of the selected booking
            Dim bookingDetails As String = $"Booking ID: {selectedRow.Cells("booking_id").Value}{Environment.NewLine}" &
                                           $"Customer Name: {selectedRow.Cells("customer_name").Value}{Environment.NewLine}" &
                                           $"Booking Date: {selectedRow.Cells("booking_date").Value}{Environment.NewLine}" &
                                           $"Pickup Time: {selectedRow.Cells("pickup_time").Value}{Environment.NewLine}" &
                                           $"Return Time: {selectedRow.Cells("return_time").Value}{Environment.NewLine}" &
                                           $"Quantity: {selectedRow.Cells("quantity").Value}{Environment.NewLine}" &
                                           $"Status: {selectedRow.Cells("status").Value}"
            MessageBox.Show(bookingDetails, "Booking Details")
        Else
            MessageBox.Show("Please select a booking to view.")
        End If
    End Sub

    ' This event triggers when the Delete button is clicked
    Private Sub btnDelete_Click(sender As Object, e As EventArgs) Handles btnDelete.Click
        Dim selectedRow As DataGridViewRow = GunaDataGridView1.CurrentRow
        If selectedRow IsNot Nothing Then
            Dim bookingId As Integer = CInt(selectedRow.Cells("booking_id").Value)

            ' Confirm deletion
            Dim confirmResult As DialogResult = MessageBox.Show("Are you sure you want to delete this booking?", "Confirm Delete", MessageBoxButtons.YesNo)
            If confirmResult = DialogResult.Yes Then
                ' Establish connection to the database
                Using connection As New MySqlConnection(connectionString)
                    Try
                        connection.Open()

                        ' Query to delete the selected booking
                        Dim query As String = "DELETE FROM bookings WHERE booking_id = @bookingId"

                        ' MySQL command to execute the delete query
                        Dim command As New MySqlCommand(query, connection)
                        command.Parameters.AddWithValue("@bookingId", bookingId)

                        ' Execute the command
                        command.ExecuteNonQuery()

                        ' Reload booking data after deletion
                        LoadBookingData()

                        MessageBox.Show("Booking deleted successfully.")
                    Catch ex As Exception
                        MessageBox.Show("Error: " & ex.Message)
                    End Try
                End Using
            End If
        Else
            MessageBox.Show("Please select a booking to delete.")
        End If
    End Sub

End Class
