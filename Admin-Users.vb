Imports Guna.UI2.WinForms
Imports MySql.Data.MySqlClient

Public Class AdminUsers
    Private Sub PictureBox10_Click(sender As Object, e As EventArgs) Handles PictureBox10.Click
        Application.Exit()
    End Sub


    Private Sub pbdash_Click(sender As Object, e As EventArgs) Handles pbdash3.Click
        AdminDash.Show()
        Me.Hide()
    End Sub
    Private Sub pbbikes_Click(sender As Object, e As EventArgs) Handles pbBikes.Click
        AdminBikes.Show()
        Me.Hide()
    End Sub

    Private Sub pbSales_Click(sender As Object, e As EventArgs) Handles pbSales.Click
        AdminSales.Show()
        Me.Hide()
    End Sub

    Private Sub pbBookings_Click(sender As Object, e As EventArgs) Handles pbBookings.Click
        AdminBookings.Show()
        Me.Hide()
    End Sub

    Private Sub pbReviews_Click(sender As Object, e As EventArgs) Handles pbReviews.Click
        AdminReviews.Show()
        Me.Hide()
    End Sub


    Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"
    Dim connection As MySqlConnection = New MySqlConnection(connectionString)

        ' Method to load users into the Guna2DataGridView
        Private Sub LoadUsers()
            Try
                connection.Open()

            ' Query to get users from the 'user' table
            Dim query As String = "SELECT user_id, fullname, email, password, profile_image, created_at, updated_at FROM users"
            Dim command As MySqlCommand = New MySqlCommand(query, connection)
                Dim adapter As MySqlDataAdapter = New MySqlDataAdapter(command)
                Dim table As DataTable = New DataTable()

                ' Fill the DataTable and bind it to the Guna2DataGridView
                adapter.Fill(table)
                Guna2DataGridViewUsers.DataSource = table

                ' Customize column headers after data is loaded
                CustomizeHeaders()

            Catch ex As Exception
                MessageBox.Show("Error: " & ex.Message)
            Finally
                connection.Close()
            End Try
        End Sub

        ' Method to customize headers
        Private Sub CustomizeHeaders()
            ' Check if the DataGridView has columns
            If Guna2DataGridViewUsers.Columns.Count > 0 Then
                ' Set custom text for each column header
                Guna2DataGridViewUsers.Columns(0).HeaderText = "User ID"
                Guna2DataGridViewUsers.Columns(1).HeaderText = "Full Name"
                Guna2DataGridViewUsers.Columns(2).HeaderText = "Email"
                Guna2DataGridViewUsers.Columns(3).HeaderText = "Profile Image"
                Guna2DataGridViewUsers.Columns(4).HeaderText = "Created At"
                Guna2DataGridViewUsers.Columns(5).HeaderText = "Updated At"

                ' Optional: Customize the appearance of the headers
                With Guna2DataGridViewUsers
                    .ColumnHeadersDefaultCellStyle.Font = New Font("Arial", 12, FontStyle.Bold)
                    .ColumnHeadersDefaultCellStyle.BackColor = Color.LightBlue
                    .ColumnHeadersDefaultCellStyle.ForeColor = Color.Black
                    .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
                    .EnableHeadersVisualStyles = False ' Disable default header styling to apply custom styles
                End With
            End If
        End Sub

        ' Form Load event
        Private Sub FormUsers_Load(sender As Object, e As EventArgs) Handles MyBase.Load
            ' Call the LoadUsers method when the form loads
            LoadUsers()
        End Sub



        Private Sub Logoutuser_Click(sender As Object, e As EventArgs) Handles logoutuser.Click
        Dim result As DialogResult = MessageBox.Show("Are you sure you want to log out?", "Log Out", MessageBoxButtons.YesNo)
        If result = DialogResult.Yes Then
            ' Show the login form and hide the admin dashboard
            Login.Show()
            Me.Hide()
        End If
    End Sub

End Class