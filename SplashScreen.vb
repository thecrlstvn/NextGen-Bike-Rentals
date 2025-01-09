Public Class SplashScreen
    Private Sub SplashScreen_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        Timer1.Enabled = True
        Timer1.Start()
    End Sub

    Private Sub Timer1_Tick(sender As Object, e As EventArgs) Handles Timer1.Tick
        ProgressBar1.Increment(1)
        lblPercentage.Text = ProgressBar1.Value & "%"
        If (ProgressBar1.Value = 100) Then
            Me.Hide()
            GetStarted.Show()
            Timer1.Enabled = False
            Timer1.Stop()
        End If
    End Sub

    Private Sub lblPercentage_Click(sender As Object, e As EventArgs) Handles lblPercentage.Click

    End Sub
End Class