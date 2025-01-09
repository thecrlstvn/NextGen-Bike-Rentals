Imports System.Text
Imports MySql.Data.MySqlClient
Imports BCrypt.Net

Public Class Login
    Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"

    Private Sub btnLogin_Click(sender As Object, e As EventArgs) Handles btnLogin.Click
        Dim email As String = txtEmail.Text.Trim()
        Dim password As String = txtPassword.Text.Trim()

        If String.IsNullOrWhiteSpace(email) Or String.IsNullOrWhiteSpace(password) Then
            txtMessage.Text = "Please enter both email and password."
            Return
        End If

        Dim adminInfo As Tuple(Of String, String) = ValidateCredentials(email, password)

        If adminInfo IsNot Nothing Then
            txtMessage.Text = "Login successful!"
            AdminDash.Show() ' Show the AdminDash form
            Me.Hide() ' Optionally hide the login form
        Else
            txtMessage.Text = "Invalid credentials."
        End If
    End Sub

    ' Function to validate credentials by comparing bcrypt hashed passwords
    Private Function ValidateCredentials(email As String, password As String) As Tuple(Of String, String)
        Using connection As New MySqlConnection(connectionString)
            Dim query As String = "SELECT admin_name, password FROM adminlogin WHERE email = @Email"
            Using command As New MySqlCommand(query, connection)
                command.Parameters.AddWithValue("@Email", email)

                connection.Open()
                Using reader As MySqlDataReader = command.ExecuteReader()
                    If reader.Read() Then
                        Dim dbPassword As String = reader("password").ToString()
                        Dim adminName As String = reader("admin_name").ToString()

                        ' Verify the entered password against the hashed password from the database
                        If BCrypt.Net.BCrypt.Verify(password, dbPassword) Then
                            Return New Tuple(Of String, String)(adminName, dbPassword)
                        End If
                    End If
                End Using
            End Using
        End Using
        Return Nothing ' Return Nothing if credentials are invalid
    End Function

    ' Function to hash the password for registration or update
    Private Function HashPassword(password As String) As String
        Return BCrypt.Net.BCrypt.HashPassword(password)
    End Function
    Private Sub chkShowPassword_CheckedChanged(sender As Object, e As EventArgs) Handles chkShowPassword.CheckedChanged
        ' If checked, show the password; if unchecked, hide the password
        If chkShowPassword.Checked Then
            txtPassword.UseSystemPasswordChar = True ' Show password
        Else
            txtPassword.UseSystemPasswordChar = False ' Hide password
        End If
    End Sub

    Private Sub Login_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        txtPassword.PasswordChar = "*" ' This hides the password as the user types
        txtPassword.UseSystemPasswordChar = True
    End Sub

    Private Sub picBoxExit2_Click(sender As Object, e As EventArgs) Handles picBoxExit2.Click
        Application.Exit()
    End Sub

End Class
