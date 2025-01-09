Imports System.Data.SqlClient
Imports Guna.UI2.WinForms
Imports System.Drawing
Imports Guna.Charts.WinForms
Imports LiveCharts
Imports LiveCharts.Wpf
Imports MySql.Data.MySqlClient
Imports System.Windows.Media
Imports System.Globalization




Public Class AdminSales
    Private Sub Chart_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadSalesTrendData()
    End Sub

    Private Sub LoadSalesTrendData()
        ' Update this connection string with your actual database credentials
        Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"
        Dim query As String = "SELECT b.booking_date, SUM(p.total_cost) AS TotalCost " &
                          "FROM bookings b " &
                          "JOIN payments p ON b.booking_id = p.booking_id " &
                          "GROUP BY b.booking_date " &
                          "ORDER BY b.booking_date;"

        Dim dates As New List(Of String)()
        Dim totalCosts As New ChartValues(Of Double)()

        Using conn As New MySqlConnection(connectionString)
            Dim cmd As New MySqlCommand(query, conn)
            Try
                conn.Open()
                Dim reader As MySqlDataReader = cmd.ExecuteReader()

                While reader.Read()
                    dates.Add(Convert.ToDateTime(reader("booking_date")).ToString("yyyy-MM-dd", CultureInfo.InvariantCulture))
                    totalCosts.Add(Convert.ToDouble(reader("TotalCost"))) ' Directly use TotalCost in PHP
                End While

                ' Bind data to the Cartesian chart
                CartesianChart1.Series.Clear()
                CartesianChart1.AxisX.Clear()
                CartesianChart1.AxisY.Clear()

                ' Add the total costs to the chart
                Dim series As New LineSeries With {
                .Values = totalCosts,
                .Title = "Total Sales in PHP",
                .StrokeThickness = 2,
                .PointGeometry = Nothing
            }

                CartesianChart1.Series.Add(series)

                ' Set up the X-Axis with booking dates
                CartesianChart1.AxisX.Add(New Axis With {
                .Title = "Booking Date",
                .Labels = dates
            })

                ' Set up the Y-Axis for total costs
                CartesianChart1.AxisY.Add(New Axis With {
                .Title = "Total Cost (PHP)",
                .LabelFormatter = Function(value) value.ToString("C2", CultureInfo.GetCultureInfo("en-PH")) ' Format as PHP currency
            })

            Catch ex As Exception
                MessageBox.Show("Error: " & ex.Message)
            Finally
                conn.Close()
            End Try
        End Using
    End Sub

    Private Sub AdminSales_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadPaymentsData()
    End Sub

    Private Sub LoadPaymentsData()
        ' Update this connection string with your actual database credentials
        Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"
        Dim query As String = "SELECT " &
                          "SUM(downpayment_amount) AS TotalDownpayments, " &
                          "SUM(total_cost) AS TotalRevenue " &
                          "FROM payments;"

        Using conn As New MySqlConnection(connectionString)
            Dim cmd As New MySqlCommand(query, conn)
            Try
                conn.Open()
                Dim reader As MySqlDataReader = cmd.ExecuteReader()

                If reader.Read() Then
                    ' Read the totals from the database (assumed to be already in PHP)
                    Dim totalDownpayments As Decimal = If(reader("TotalDownpayments"), 0)
                    Dim totalRevenue As Decimal = If(reader("TotalRevenue"), 0)

                    ' Display totals in Guna TextBoxes
                    Me.TotalDownpayments.Text = $"{totalDownpayments:C2}" ' Format as PHP currency
                    Me.TotalRevenue.Text = $"{totalRevenue:C2}" ' Format as PHP currency

                    ' Clear previous series and set new data for the pie chart
                    Guna2Chart2.Series.Clear()

                    ' Add series for each payment category
                    Guna2Chart2.Series.Add(New PieSeries With {
                    .Values = New ChartValues(Of Double) From {Convert.ToDouble(totalDownpayments)},
                    .DataLabels = True,
                    .Title = $"Total Downpayments: {totalDownpayments:C2}",
                    .Fill = New SolidColorBrush(Colors.Blue)
                })

                    Guna2Chart2.Series.Add(New PieSeries With {
                    .Values = New ChartValues(Of Double) From {Convert.ToDouble(totalRevenue)},
                    .DataLabels = True,
                    .Title = $"Total Revenue: {totalRevenue:C2}",
                    .Fill = New SolidColorBrush(Colors.Green)
                })

                    ' Set chart legend location
                    Guna2Chart2.LegendLocation = LegendLocation.Right
                End If
            Catch ex As Exception
                MessageBox.Show("Error: " & ex.Message)
            Finally
                conn.Close()
            End Try
        End Using
    End Sub

    Private Sub Sales_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        ShowTotalBookings()
    End Sub

    Private Sub ShowTotalBookings()
        Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"
        Dim query As String = "SELECT COUNT(DISTINCT payment_id) AS total_bookings FROM payments"

        Using conn As New MySqlConnection(connectionString)
            Try
                conn.Open()
                Using cmd As New MySqlCommand(query, conn)
                    Dim totalBookings As Integer = Convert.ToInt32(cmd.ExecuteScalar())
                    Guna2TBTotalBookings.Text = totalBookings.ToString() ' Display in Guna TextBox
                End Using

            Catch ex As Exception
                MessageBox.Show("Error retrieving total bookings: " & ex.Message)
            End Try
        End Using
    End Sub
    Public Class DatabaseHelper
        Private Shared ReadOnly connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"

        ' Method to return a new connection
        Public Shared Function GetConnection() As MySqlConnection
            Return New MySqlConnection(connectionString)
        End Function
    End Class
    Private Sub SummerySales_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        ' Configure Guna2DataGridView columns (without Action column)
        With SummaryTable
            .ColumnCount = 8
            .Columns(0).Name = "Booking Date"
            .Columns(1).Name = "Bike Name"
            .Columns(2).Name = "Bike Brand"
            .Columns(3).Name = "Quantity"
            .Columns(4).Name = "Rate Type"
            .Columns(5).Name = "Total Cost"
            .Columns(6).Name = "Payment Method"
            .Columns(7).Name = "Payment Status"

            ' Customize DataGridView appearance (optional)
            .AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            .AllowUserToAddRows = False
        End With

        ' Load data from the database
        LoadSalesData()
    End Sub

    Private Sub LoadSalesData()
        ' Define the SQL query to get data from 'bookings', 'bikes', and 'payments'
        Dim query As String = "
        SELECT 
            bookings.booking_date, 
            bikes.bike_name, 
            bikes.bike_brand, 
            bookings.quantity, 
            bookings.rate_type, 
            payments.total_cost, 
            payments.payment_method, 
            payments.payment_status
        FROM 
            bookings
        INNER JOIN 
            bikes ON bookings.bikeid = bikes.bikeid
        INNER JOIN 
            payments ON bookings.booking_id = payments.booking_id"

        Try
            ' Establish a connection to the database
            Using connection As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                connection.Open()

                ' Create a new MySQL command with the query
                Dim command As New MySqlCommand(query, connection)

                ' Execute the query and get the data
                Dim reader As MySqlDataReader = command.ExecuteReader()

                ' Iterate through the results and add them to the DataGridView
                While reader.Read()
                    SummaryTable.Rows.Add(
                    reader("booking_date").ToString(),
                    reader("bike_name").ToString(),
                    reader("bike_brand").ToString(),
                    reader("quantity").ToString(),
                    reader("rate_type").ToString(),
                    reader("total_cost").ToString(),
                    reader("payment_method").ToString(),
                    reader("payment_status").ToString()
                )
                End While
            End Using
        Catch ex As Exception
            ' Handle any errors that occur during the database connection or execution
            MessageBox.Show("An error occurred: " & ex.Message)
        End Try
    End Sub



    Private Sub ViewDetails_Click(sender As Object, e As EventArgs) Handles btnView.Click
        If SummaryTable.SelectedRows.Count > 0 Then
            Dim selectedRow As DataGridViewRow = SummaryTable.SelectedRows(0)
            Dim bookingDate As String = selectedRow.Cells("Booking Date").Value.ToString()
            Dim bikeName As String = selectedRow.Cells("Bike Name").Value.ToString()
            Dim bikeBrand As String = selectedRow.Cells("Bike Brand").Value.ToString()
            Dim quantity As String = selectedRow.Cells("Quantity").Value.ToString()
            Dim rateType As String = selectedRow.Cells("Rate Type").Value.ToString()
            Dim totalCost As String = selectedRow.Cells("Total Cost").Value.ToString()
            Dim paymentMethod As String = selectedRow.Cells("Payment Method").Value.ToString()
            Dim paymentStatus As String = selectedRow.Cells("Payment Status").Value.ToString()

            MessageBox.Show($"Booking Date: {bookingDate}" & vbCrLf &
                        $"Bike Name: {bikeName}" & vbCrLf &
                        $"Bike Brand: {bikeBrand}" & vbCrLf &
                        $"Quantity: {quantity}" & vbCrLf &
                        $"Rate Type: {rateType}" & vbCrLf &
                        $"Total Cost: {totalCost}" & vbCrLf &
                        $"Payment Method: {paymentMethod}" & vbCrLf &
                        $"Payment Status: {paymentStatus}", "Booking Details")
        Else
            MessageBox.Show("Please select a row to view details.")
        End If
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

    Private Sub pbBookings_Click(sender As Object, e As EventArgs) Handles pbBookings.Click
        AdminBookings.Show()
        Me.Hide()
    End Sub

    Private Sub pbReviews_Click(sender As Object, e As EventArgs) Handles pbReviews.Click
        AdminReviews.Show()
        Me.Hide()
    End Sub


    Private Sub logoutsales_Click(sender As Object, e As EventArgs) Handles logoutsales.Click
        Dim result As DialogResult = MessageBox.Show("Are you sure you want to log out?", "Log Out", MessageBoxButtons.YesNo)
        If result = DialogResult.Yes Then
            ' Show the login form and hide the admin dashboard
            Login.Show()
            Me.Hide()
        End If
    End Sub

    Private Sub btnGenerateReports_Click_1(sender As Object, e As EventArgs) Handles btnGenerateReports.Click
        AdminReviews.Show()
        Me.Hide()
    End Sub
End Class
