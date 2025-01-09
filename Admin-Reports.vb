

Imports DinkToPdf
Imports MySql.Data.MySqlClient
Imports System.IO
Imports DinkToPdf.Contracts

Public Class AdminReports
    Private Sub PictureBox10_Click(sender As Object, e As EventArgs)
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

    Private Sub pbBookings_Click(sender As Object, e As EventArgs) Handles pbBookings.Click
        AdminBookings.Show()
        Me.Hide()
    End Sub

    Private Sub pbReviews_Click(sender As Object, e As EventArgs) Handles pbReviews.Click
        AdminReviews.Show()
        Me.Hide()
    End Sub

    Private Sub logoutreports_Click(sender As Object, e As EventArgs) Handles logoutreports.Click
        Dim result As DialogResult = MessageBox.Show("Are you sure you want to log out?", "Log Out", MessageBoxButtons.YesNo)
        If result = DialogResult.Yes Then
            ' Show the login form and hide the admin dashboard
            Login.Show()
            Me.Hide()
        End If
    End Sub



    ' PDF Converter instance (for DinkToPdf)
    Private pdfConverter As SynchronizedConverter = New SynchronizedConverter(New PdfTools())

    ' Database connection (replace with your actual connection setup)
    Private conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")

    ' Fetch data function with guaranteed return value
    Private Function FetchData(query As String, ParamArray parameters As Object()) As Object
        ' Ensure the connection is open
        If conn.State <> ConnectionState.Open Then
            conn.Open()
        End If

        Try
            Using cmd As New MySqlCommand(query, conn)
                For i As Integer = 0 To parameters.Length - 1
                    cmd.Parameters.AddWithValue("@" & i, parameters(i))
                Next
                Using reader As MySqlDataReader = cmd.ExecuteReader()
                    If reader.Read() Then
                        Return reader(0)
                    End If
                End Using
            End Using
        Catch ex As Exception
            MessageBox.Show("Error fetching data: " & ex.Message)
        Finally
            ' Close the connection after the operation
            If conn.State = ConnectionState.Open Then
                conn.Close()
            End If
        End Try

        ' Return a default value (e.g., Nothing) if no data was found
        Return Nothing
    End Function

    ' Guna Button click event to generate PDF
    Private Sub gunaBtnGenerateReport_Click(sender As Object, e As EventArgs) Handles btnGenerateReport.Click
        Dim startDate As Date = dateTimePickerStart.Value
        Dim endDate As Date = dateTimePickerEnd.Value
        Dim reportFile As String = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "reports", $"report_{DateTime.Now:yyyyMMdd_HHmmss}.pdf")

        ' Create reports directory if it doesn't exist
        Directory.CreateDirectory(Path.GetDirectoryName(reportFile))

        ' Database query results for summary sections
        Dim summaries As New Dictionary(Of String, Object) From {
                {"totalBookings", FetchData("SELECT COUNT(*) FROM bookings WHERE booking_date BETWEEN @0 AND @1", startDate, endDate)},
                {"totalQuantity", FetchData("SELECT SUM(quantity) FROM bookings WHERE booking_date BETWEEN @0 AND @1", startDate, endDate)},
                {"totalRevenue", FetchData("SELECT SUM(quantity * CASE WHEN rate_type = 'hourly' THEN hourly_rate ELSE daily_rate END) FROM bookings b JOIN bikes bi ON b.bikeid = bi.bikeid WHERE booking_date BETWEEN @0 AND @1", startDate, endDate)},
                {"totalReceived", FetchData("SELECT SUM(downpayment_amount + remaining_amount) FROM payments WHERE created_at BETWEEN @0 AND @1", startDate, endDate)},
                {"totalOutstanding", FetchData("SELECT SUM(remaining_amount) FROM payments WHERE created_at BETWEEN @0 AND @1", startDate, endDate)},
                {"totalReturned", FetchData("SELECT COUNT(*) FROM returned_bikes WHERE return_time BETWEEN @0 AND @1", startDate, endDate)},
                {"totalBikes", FetchData("SELECT COUNT(*) FROM bikes")},
                {"availableBikes", FetchData("SELECT COUNT(*) FROM bikes WHERE availability_status = 'available'")},
                {"totalUsers", FetchData("SELECT COUNT(*) FROM users")},
                {"totalReviews", FetchData("SELECT COUNT(*) FROM reviews")},
                {"averageRating", FetchData("SELECT AVG(rating) FROM reviews")}
            }

        ' HTML content for the PDF
        Dim htmlContent As String = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; }
                    .header { text-align: center; background-color: #00831D; color: white; padding: 10px; }
                    h1, h2 { margin: 5px; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
                    th { background-color: #f2f2f2; font-weight: bold; }
                    .details { text-align: left; }
                </style>
            </head>
            <body>
                <div class='header'>
                    <h1>Nextgen Bike Rentals Store</h1>
                    <p>Email: rentals.nextgenbikes@gmail.com</p>
                    <p>Tel No: 415-1111 / 924-2684</p>
                </div>
                <h2>Summary Report</h2>
                <p>From " & startDate.ToShortDateString() & " to " & endDate.ToShortDateString() & "</p>
                <table>
                    <tr><th>Data Table</th><th>Total</th><th>Details</th></tr>
                    <tr><td>Bookings</td><td>" & summaries("totalBookings") & "</td><td>Total Quantity: " & summaries("totalQuantity") & "<br>Total Revenue: PHP " & summaries("totalRevenue") & "</td></tr>
                    <tr><td>Payments</td><td>PHP " & summaries("totalReceived") & "</td><td>Total Outstanding: PHP " & summaries("totalOutstanding") & "</td></tr>
                    <tr><td>Returned Bikes</td><td>" & summaries("totalReturned") & "</td><td></td></tr>
                    <tr><td>Bikes</td><td>" & summaries("totalBikes") & "</td><td>Available: " & summaries("availableBikes") & "</td></tr>
                    <tr><td>Users</td><td>" & summaries("totalUsers") & "</td><td></td></tr>
                    <tr><td>Reviews</td><td>" & summaries("totalReviews") & "</td><td>Average Rating: " & summaries("averageRating") & "</td></tr>
                </table>
            </body>
            </html>"

        ' Create the HTML to PDF document
        Dim pdfDoc As New HtmlToPdfDocument() With {
    .GlobalSettings = New GlobalSettings() With {
        .PaperSize = PaperKind.A4,
        .Orientation = Orientation.Portrait
    }
}

        ' Add ObjectSettings to the document's Objects collection
        pdfDoc.Objects.Add(New ObjectSettings() With {.HtmlContent = htmlContent})


        Try
            Dim pdfBytes As Byte() = pdfConverter.Convert(pdfDoc)
            File.WriteAllBytes(reportFile, pdfBytes)
            label.Text = $"PDF generated successfully: {reportFile}"
        Catch ex As Exception
            label.Text = "Failed to generate PDF: " & ex.Message
        End Try
        syncfusionPdfViewer.Load(reportFile)

    End Sub

    Private Sub backbutton2_Click(sender As Object, e As EventArgs) Handles backbutton2.Click
        AdminSales.Show()
        Me.Hide()
    End Sub
End Class
