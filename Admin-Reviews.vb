Imports System.IO
Imports System.Net
Imports System.Drawing
Imports System.Data.SqlClient
Imports System.Windows.Forms
Imports MySql.Data.MySqlClient



Public Class AdminReviews
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

    Private Sub pbBookings_Click(sender As Object, e As EventArgs) Handles pbBookings.Click
        AdminBookings.Show()
        Me.Hide()
    End Sub


    Private Sub logoutreviews_Click(sender As Object, e As EventArgs) Handles logoutreviews.Click
        Dim result As DialogResult = MessageBox.Show("Are you sure you want to log out?", "Log Out", MessageBoxButtons.YesNo)
        If result = DialogResult.Yes Then
            ' Show the login form and hide the admin dashboard
            Login.Show()
            Me.Hide()
        End If
    End Sub

    Private connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"

    Private Sub ReviewForm_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadReviews()
    End Sub
    Private Sub LoadReviews()
        Dim reviews As New List(Of Review)()

        Using connection As New MySqlConnection(connectionString)
            Try
                connection.Open()
                Dim sql As String = "SELECT r.*, u.fullname, u.profile_image FROM reviews r JOIN users u ON r.user_id = u.user_id ORDER BY r.date_posted DESC"
                Dim command As New MySqlCommand(sql, connection)
                Dim reader As MySqlDataReader = command.ExecuteReader()

                ' Clear existing rows
                DataGridViewReviews.Rows.Clear()

                While reader.Read()
                    Dim review As New Review With {
                    .ReviewId = reader("review_id").ToString(),
                    .Fullname = reader("fullname").ToString(),
                    .ProfileImage = If(reader("profile_image") Is DBNull.Value, String.Empty, reader("profile_image").ToString()),
                    .Slug = reader("slug").ToString(),
                    .Rating = Convert.ToInt32(reader("rating")),
                    .ReviewText = reader("review_text").ToString(),
                    .DatePosted = Convert.ToDateTime(reader("date_posted"))
                }
                    reviews.Add(review)
                End While

                If reviews.Count = 0 Then
                    MessageBox.Show("No reviews found.")
                Else
                    ' Bind reviews to DataGridView and set profile images
                    For Each review In reviews
                        Dim rowIndex As Integer = DataGridViewReviews.Rows.Add()
                        Dim row As DataGridViewRow = DataGridViewReviews.Rows(rowIndex)

                        ' Check if the profile image exists
                        If Not String.IsNullOrEmpty(review.ProfileImage) Then
                            Try
                                ' Load profile image from Cloudinary URL
                                Dim img As Image = LoadImageFromUrl(review.ProfileImage)
                                row.Cells(0).Value = img
                            Catch ex As Exception
                                ' Handle image loading error (optional)
                                row.Cells(0).Value = Nothing
                            End Try
                        Else
                            ' No profile image (NULL or empty), leave the cell empty
                            row.Cells(0).Value = Nothing
                        End If

                        ' Set other values
                        row.Cells(1).Value = review.Fullname
                        row.Cells(2).Value = review.Slug
                        row.Cells(3).Value = CreateStarRatingImage(review.Rating) ' Use star image here
                        row.Cells(4).Value = review.ReviewText
                        row.Cells(5).Value = review.DatePosted.ToString("g") ' Format for display
                    Next
                End If

            Catch ex As MySqlException
                MessageBox.Show("Error executing query: " & ex.Message)
            Finally
                connection.Close()
            End Try
        End Using
    End Sub

    Private Function CreateStarRatingImage(rating As Integer) As Image
        Dim starImage As New Bitmap(100, 20) ' Adjust size as needed
        Using g As Graphics = Graphics.FromImage(starImage)
            For i As Integer = 0 To 4
                If i < rating Then
                    ' Draw filled star
                    g.FillPolygon(Brushes.Gold, New Point() {
                    New Point(10 + i * 20, 0),
                    New Point(15 + i * 20, 15),
                    New Point(0 + i * 20, 5),
                    New Point(20 + i * 20, 5),
                    New Point(5 + i * 20, 15)
                })
                Else
                    ' Draw empty star
                    g.DrawPolygon(Pens.Gray, New Point() {
                    New Point(10 + i * 20, 0),
                    New Point(15 + i * 20, 15),
                    New Point(0 + i * 20, 5),
                    New Point(20 + i * 20, 5),
                    New Point(5 + i * 20, 15)
                })
                End If
            Next
        End Using
        Return starImage
    End Function

    Private Function LoadImageFromUrl(url As String) As Image
        Using webClient As New WebClient()
            Dim imageBytes As Byte() = webClient.DownloadData(url)
            Using ms As New IO.MemoryStream(imageBytes)
                Return Image.FromStream(ms)
            End Using
        End Using
    End Function

    Private Sub btnDelete_Click(sender As Object, e As EventArgs) Handles btnDelete.Click
        If DataGridViewReviews.SelectedRows.Count > 0 Then
            Dim reviewId As String = DataGridViewReviews.SelectedRows(0).Cells("review_id").Value.ToString()
            If MessageBox.Show("Are you sure you want to delete this review?", "Confirm Delete", MessageBoxButtons.YesNo, MessageBoxIcon.Warning) = DialogResult.Yes Then
                DeleteReview(reviewId)
            End If
        Else
            MessageBox.Show("Please select a review to delete.")
        End If
    End Sub

    Private Sub DeleteReview(reviewId As String)
        Using connection As New MySqlConnection(connectionString)
            Try
                connection.Open()
                Dim sql As String = "DELETE FROM reviews WHERE review_id = @reviewId"
                Dim command As New MySqlCommand(sql, connection)
                command.Parameters.AddWithValue("@reviewId", reviewId)
                Dim rowsAffected As Integer = command.ExecuteNonQuery()

                If rowsAffected > 0 Then
                    MessageBox.Show("Review deleted successfully.")
                    LoadReviews() ' Reload reviews after deletion
                Else
                    MessageBox.Show("No review found with the specified ID.")
                End If

            Catch ex As MySqlException
                MessageBox.Show("Error executing delete: " & ex.Message)
            Finally
                connection.Close()
            End Try
        End Using
    End Sub
    Private Sub btnViewDetails_Click(sender As Object, e As EventArgs) Handles btnViewDetails.Click
        ' Check if a row is selected in the DataGridView
        If DataGridViewReviews.SelectedRows.Count > 0 Then
            ' Get the selected row
            Dim selectedRow As DataGridViewRow = DataGridViewReviews.SelectedRows(0)

            ' Safely retrieve the values from the selected row using column indices
            Dim profileImage As String = If(selectedRow.Cells(0).Value?.ToString(), "No profile image")
            Dim fullname As String = If(selectedRow.Cells(1).Value?.ToString(), "No fullname")
            Dim slug As String = If(selectedRow.Cells(2).Value?.ToString(), "No slug")

            ' For the Rating column, handle null or invalid values separately (use 0 as default)
            Dim rating As Integer = If(selectedRow.Cells(3).Value IsNot Nothing AndAlso IsNumeric(selectedRow.Cells(3).Value), Convert.ToInt32(selectedRow.Cells(3).Value), 0)

            Dim reviewText As String = If(selectedRow.Cells(4).Value?.ToString(), "No review text")
            Dim datePosted As String = If(selectedRow.Cells(5).Value?.ToString(), "No date posted")

            ' Create a message string with the review details
            Dim message As String = $"Profile Image: {profileImage}" & Environment.NewLine &
                                    $"Full Name: {fullname}" & Environment.NewLine &
                                    $"Slug: {slug}" & Environment.NewLine &
                                    $"Rating: {rating}" & Environment.NewLine &
                                    $"Review: {reviewText}" & Environment.NewLine &
                                    $"Date Posted: {datePosted}"

            ' Show the message in a message box
            MessageBox.Show(message, "Review Details", MessageBoxButtons.OK, MessageBoxIcon.Information)
        Else
            MessageBox.Show("Please select a review to view its details.", "No Review Selected", MessageBoxButtons.OK, MessageBoxIcon.Warning)
        End If
    End Sub





End Class



Public Class Review
        Public Property ReviewId As String
        Public Property Fullname As String
        Public Property ProfileImage As String
        Public Property Slug As String
        Public Property Rating As Integer
        Public Property ReviewText As String
        Public Property DatePosted As DateTime
    End Class
