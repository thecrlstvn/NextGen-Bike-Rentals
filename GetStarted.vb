Public Class GetStarted
    Private Sub GetStarted_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        ' Initialization code (if needed)
    End Sub

    Private Sub GetStartedButton_Click(sender As Object, e As EventArgs) Handles GetStartedButton.Click
        ' Show the Login form
        Login.Show()
        ' Hide the GetStarted form (optional)
        Me.Hide()
    End Sub

    Private Sub picBoxExit1_Click(sender As Object, e As EventArgs) Handles picBoxExit1.Click
        Application.Exit()
    End Sub
End Class
