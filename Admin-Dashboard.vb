Imports System.Windows
Imports Guna.Charts.WinForms
Imports Guna.UI2.WinForms
Imports LiveCharts
Imports LiveCharts.Wpf
Imports MySql.Data.MySqlClient
Imports System.Drawing

Public Class AdminDash
    Private currentMonth As Integer
    Private currentYear As Integer
    Private bookings As New Dictionary(Of DateTime, String)() ' To store bookings

    Private Sub Calendar_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        ' Initialize to current month and year
        currentMonth = DateTime.Now.Month
        currentYear = DateTime.Now.Year
        LoadBookings() ' Load bookings from the database
        LoadCalendar()
    End Sub

    Private Sub LoadBookings()
        ' Clear previous bookings
        bookings.Clear()

        ' Database connection string
        Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"

        ' Retrieve bookings from the database
        Try
            Using conn As New MySqlConnection(connectionString)
                Dim cmd As New MySqlCommand("SELECT booking_date, customer_name FROM bookings", conn)
                conn.Open()

                Using reader As MySqlDataReader = cmd.ExecuteReader()
                    While reader.Read()
                        ' Check if booking_date is NULL or invalid
                        If Not reader.IsDBNull(reader.GetOrdinal("booking_date")) Then
                            Dim bookingDateStr As String = reader("booking_date").ToString()
                            Dim customerName As String = reader.GetString("customer_name")

                            ' Check for invalid date like '0000-00-00' or any non-representable date
                            If bookingDateStr = "0000-00-00" OrElse bookingDateStr.Contains("0000") Then
                                ' Log invalid date and skip the entry
                                Console.WriteLine($"Invalid date for booking: {customerName}, skipping entry.")
                                Continue While
                            End If

                            ' Try to parse the booking date string to DateTime
                            Dim bookingDate As DateTime
                            If DateTime.TryParse(bookingDateStr, bookingDate) AndAlso bookingDate > DateTime.MinValue Then
                                ' Store customer name by booking date if the date is valid
                                bookings(bookingDate) = customerName
                            Else
                                ' Log invalid date formats (optional)
                                Console.WriteLine($"Invalid date format for booking: {customerName}, skipping entry.")
                            End If
                        Else
                            ' Log NULL dates (optional)
                            Console.WriteLine("Booking date is NULL, skipping entry.")
                        End If
                    End While
                End Using
            End Using

        Catch ex As MySqlException
            ' Handle potential database connection errors
            Console.WriteLine("Database connection error: " & ex.Message)
        Catch ex As Exception
            ' Handle other potential errors
            Console.WriteLine("An error occurred: " & ex.Message)
        End Try
    End Sub






    Private Sub LoadCalendar()
        ' Clear previous controls
        tablecalendar.Controls.Clear()
        tablecalendar.ColumnStyles.Clear()
        tablecalendar.RowStyles.Clear()

        ' Display month/year
        lblMonthYear.Text = New DateTime(currentYear, currentMonth, 1).ToString("MMMM yyyy")

        ' Days of the week headers
        Dim days As String() = {"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"}
        For i As Integer = 0 To 6
            Dim header As New Label() With {
            .Text = days(i),
            .Font = New Font("Arial Rounded MT", 10, System.Drawing.FontStyle.Bold),
            .TextAlign = ContentAlignment.MiddleCenter
        }
            tablecalendar.Controls.Add(header, i, 0) ' Header row
            tablecalendar.ColumnStyles.Add(New ColumnStyle(SizeType.Percent, 14.2857F)) ' 100% / 7 columns
        Next

        ' Populate calendar days
        Dim firstDay As New DateTime(currentYear, currentMonth, 1)
        Dim lastDay As New DateTime(currentYear, currentMonth, DateTime.DaysInMonth(currentYear, currentMonth))
        Dim startCell As Integer = CInt(firstDay.DayOfWeek)
        Dim dayCounter As Integer = 1

        For row As Integer = 1 To 6
            tablecalendar.RowStyles.Add(New RowStyle(SizeType.Percent, 16.6667F)) ' 100% / 6 rows
            For col As Integer = 0 To 6
                If (row = 1 And col < startCell) Or dayCounter > lastDay.Day Then
                    tablecalendar.Controls.Add(New Label(), col, row) ' Empty cells
                Else
                    Dim dayButton As New Guna2Button() With {
                    .Text = dayCounter.ToString(),
                    .Dock = DockStyle.Fill,
                    .Tag = New DateTime(currentYear, currentMonth, dayCounter), ' Store the date
                    .Font = New Font("Arial Rounded MT", 10, System.Drawing.FontStyle.Bold) ' Use System.Drawing.FontStyle
                }

                    ' Show customer name if there is a booking for this day
                    Dim bookingDate As New DateTime(currentYear, currentMonth, dayCounter)
                    If bookings.ContainsKey(bookingDate) Then
                        dayButton.Text &= vbCrLf & bookings(bookingDate) ' Append customer name
                        dayButton.FillColor = Color.LightBlue ' Change button color if there's a booking
                        dayButton.ForeColor = Color.Black ' Change text color for better visibility
                    End If

                    AddHandler dayButton.Click, AddressOf DayButton_Click
                    tablecalendar.Controls.Add(dayButton, col, row) ' Add day button
                    dayCounter += 1
                End If
            Next
        Next
    End Sub

    Private Sub DayButton_Click(sender As Object, e As EventArgs)
        Dim button As Guna2Button = CType(sender, Guna2Button)
        Dim selectedDate As DateTime = CType(button.Tag, DateTime)
        MessageBox.Show($"Selected Day: {selectedDate.ToString("d")} - {lblMonthYear.Text}" & vbCrLf &
If(bookings.ContainsKey(selectedDate), "Customer: " & bookings(selectedDate), "No bookings"))
    End Sub
    Private Sub btnPrevious_Click(sender As Object, e As EventArgs) Handles btnPrevious.Click
        If currentMonth = 1 Then
            currentMonth = 12
            currentYear -= 1
        Else
            currentMonth -= 1
        End If
        LoadBookings() ' Reload bookings when navigating
        LoadCalendar()
    End Sub

    Private Sub btnNext_Click(sender As Object, e As EventArgs) Handles btnNext.Click
        If currentMonth = 12 Then
            currentMonth = 1
            currentYear += 1
        Else
            currentMonth += 1
        End If
        LoadBookings() ' Reload bookings when navigating
        LoadCalendar()
    End Sub

    Private Sub SalesTotal_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        ShowTotalSales()
    End Sub
    Private Sub ShowTotalSales()
        Try
            Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                conn.Open()
                Dim cmd As New MySqlCommand("SELECT SUM(total_cost) FROM payments", conn)

                Dim totalSales As Object = cmd.ExecuteScalar()

                ' Check if totalSales is DBNull and set the TextBox accordingly
                If totalSales IsNot DBNull.Value Then
                    gunaTotalSales.Text = Convert.ToDecimal(totalSales).ToString("C") ' Format as currency
                Else
                    gunaTotalSales.Text = "₱0.00" ' or another default value
                End If
            End Using
        Catch ex As MySqlException
            MessageBox.Show("Error retrieving total sales: " & ex.Message)
        End Try
    End Sub

    Private Sub UserTotal_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        ShowUserCount()
    End Sub
    Private Sub ShowUserCount()
        Try
            Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                conn.Open()
                Dim cmd As New MySqlCommand("SELECT COUNT(*) FROM users", conn)

                Dim userCount As Integer = Convert.ToInt32(cmd.ExecuteScalar())
                gunaUserCount.Text = userCount.ToString()
            End Using
        Catch ex As MySqlException
            MessageBox.Show("Error retrieving user count: " & ex.Message)
        End Try
    End Sub

    Private Sub AvailableBikes_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadAvailableBikesCount()
    End Sub
    Private Sub LoadAvailableBikesCount()
        Try
            Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                Dim query As String = "SELECT COUNT(*) FROM bikes WHERE availability_status = 'Available'"
                Dim cmd As New MySqlCommand(query, conn)

                conn.Open()
                Dim availableBikesCount As Integer = Convert.ToInt32(cmd.ExecuteScalar())
                gunaAvailableBikes.Text = availableBikesCount.ToString() ' Display count in Guna TextBox
            End Using
        Catch ex As MySqlException
            MessageBox.Show("Error loading available bikes count: " & ex.Message)
        End Try
    End Sub

    Private Sub TotalBookings_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadTotalBookings()
    End Sub

    Private Sub LoadTotalBookings()
        Try
            Using conn As New MySqlConnection("server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;")
                Dim query As String = "SELECT COUNT(*) FROM bookings"
                Dim cmd As New MySqlCommand(query, conn)

                conn.Open()
                Dim totalBookings As Integer = Convert.ToInt32(cmd.ExecuteScalar())
                gunaTotalBookings.Text = totalBookings.ToString()
            End Using
        Catch ex As MySqlException
            MessageBox.Show("Error loading total bookings: " & ex.Message)
        End Try
    End Sub


    ' WAG GALAWIN, TAPOS NA YUNG SA TAAS NA CODE

    ' Monthly Bookings Chart Code
    Private Sub MonthlyBookings_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadMonthlyBookings()
        LoadBookingDetails() ' Load detailed booking information on form load
    End Sub

    Private Sub LoadMonthlyBookings()
        ' Update this connection string with your actual database credentials
        Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"

        ' Modified query to handle NULL values in booking_date using IFNULL
        Dim query As String = "SELECT MONTH(IFNULL(booking_date, '0001-01-01')) AS BookingMonth, COUNT(*) AS TotalBookings " &
                          "FROM bookings " &
                          "WHERE booking_date IS NOT NULL " &
                          "GROUP BY BookingMonth " &
                          "ORDER BY BookingMonth;"

        Using conn As New MySqlConnection(connectionString)
            Dim cmd As New MySqlCommand(query, conn)
            Try
                conn.Open()
                Dim reader As MySqlDataReader = cmd.ExecuteReader()

                ' Variables to store chart data
                Dim bookingValues As New ChartValues(Of Integer)()
                Dim monthLabels As New List(Of String)({"J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"})

                While reader.Read()
                    ' Retrieve data for each month
                    Dim month As Integer = reader("BookingMonth")
                    Dim totalBookings As Integer = reader("TotalBookings")

                    ' Ensure the month is within a valid range before adding it to the chart data
                    If month >= 1 AndAlso month <= 12 Then
                        bookingValues.Add(totalBookings)
                    End If
                End While

                ' Pass the data to the column chart
                DisplayColumnChart(bookingValues, monthLabels)
            Catch ex As Exception
                MessageBox.Show("Error loading monthly bookings: " & ex.Message)
            Finally
                conn.Close()
            End Try
        End Using
    End Sub


    Private Sub DisplayColumnChart(bookingValues As ChartValues(Of Integer), monthLabels As List(Of String))
        MBOveriew.Series.Clear()
        MBOveriew.Series.Add(New ColumnSeries With {
        .Values = bookingValues,
        .Title = "Bookings",
        .Fill = System.Windows.Media.Brushes.SteelBlue
    })

        MBOveriew.AxisX.Clear()
        MBOveriew.AxisX.Add(New Axis With {
        .Title = "Months",
        .Labels = monthLabels
    })

        MBOveriew.AxisY.Clear()
        MBOveriew.AxisY.Add(New Axis With {
        .Title = "Number of Bookings",
        .LabelFormatter = Function(value) value.ToString()
    })

        MBOveriew.LegendLocation = LegendLocation.Right
    End Sub
    Private Sub LoadBookingDetails()
        Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"
        Dim query As String = "SELECT booking_id, bikeid, IFNULL(booking_date, '0000-00-00') AS booking_date, " &
                          "IFNULL(pickup_time, '00:00:00') AS pickup_time, IFNULL(return_time, '00:00:00') AS return_time, " &
                          "quantity, rate_type, status, bike_size, customer_name, customer_email, " &
                          "IFNULL(updated_at, '0000-00-00') AS updated_at, user_id FROM bookings"

        Using conn As New MySqlConnection(connectionString)
            Dim cmd As New MySqlCommand(query, conn)
            Try
                conn.Open()
                Dim reader As MySqlDataReader = cmd.ExecuteReader()

                ' Process the booking details
                While reader.Read()
                    Dim bookingID As Integer = If(IsDBNull(reader("booking_id")), 0, reader("booking_id"))
                    Dim bikeID As Integer = If(IsDBNull(reader("bikeid")), 0, reader("bikeid"))
                    Dim bookingDate As String = If(IsDBNull(reader("booking_date")), "0000-00-00", reader("booking_date").ToString())
                    Dim pickupTime As String = If(IsDBNull(reader("pickup_time")), "00:00:00", reader("pickup_time").ToString())
                    Dim returnTime As String = If(IsDBNull(reader("return_time")), "00:00:00", reader("return_time").ToString())
                    Dim quantity As Integer = If(IsDBNull(reader("quantity")), 0, reader("quantity"))
                    Dim rateType As String = If(IsDBNull(reader("rate_type")), String.Empty, reader("rate_type").ToString())
                    Dim status As String = If(IsDBNull(reader("status")), String.Empty, reader("status").ToString())
                    Dim bikeSize As String = If(IsDBNull(reader("bike_size")), String.Empty, reader("bike_size").ToString())
                    Dim customerName As String = If(IsDBNull(reader("customer_name")), String.Empty, reader("customer_name").ToString())
                    Dim customerEmail As String = If(IsDBNull(reader("customer_email")), String.Empty, reader("customer_email").ToString())
                    Dim updatedAt As String = If(IsDBNull(reader("updated_at")), "0000-00-00", reader("updated_at").ToString())
                    Dim userID As Integer = If(IsDBNull(reader("user_id")), 0, reader("user_id"))

                    ' Here you can display or handle each booking's detailed information as needed.
                    ' For example, you might populate a DataGridView or output to a TextBox.
                End While
            Catch ex As Exception
                MessageBox.Show("Error loading booking details: " & ex.Message)
            Finally
                conn.Close()
            End Try
        End Using
    End Sub


    'Done done done
    Private Sub MonthlyPayments_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadMonthlyPayments()
    End Sub

    Private Sub LoadMonthlyPayments()
        ' Update this connection string with your actual database credentials
        Dim connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"
        Dim query As String = "SELECT MONTH(created_at) AS PaymentMonth, SUM(total_cost) AS TotalPayments " &
                              "FROM payments " &
                              "GROUP BY PaymentMonth " &
                              "ORDER BY PaymentMonth;"

        Using conn As New MySqlConnection(connectionString)
            Dim cmd As New MySqlCommand(query, conn)
            Try
                conn.Open()
                Dim reader As MySqlDataReader = cmd.ExecuteReader()

                ' Variables to store chart data for each month
                Dim paymentValues As New ChartValues(Of Decimal)(New Decimal(11) {}) ' Initialize array for 12 months
                Dim monthLabels As New List(Of String)({"Jan", "Feb", "Mar", "Apr", "May", "June",
                                                        "July", "Aug", "Sep", "Oct", "Nov", "Dec"})

                ' Populate payment values with data, set default 0 for months with no data
                While reader.Read()
                    Dim month As Integer = reader("PaymentMonth") - 1 ' Adjust for zero-based index
                    Dim totalPayments As Decimal = reader("TotalPayments")
                    paymentValues(month) = totalPayments
                End While

                ' Pass the data to the column chart
                DisplayPaymentChart(paymentValues, monthLabels)
            Catch ex As Exception
                MessageBox.Show("Error: " & ex.Message)
            Finally
                conn.Close()
            End Try
        End Using
    End Sub

    Private Sub DisplayPaymentChart(paymentValues As ChartValues(Of Decimal), monthLabels As List(Of String))
        ' Clear previous series and set new data
        MPOverview.Series.Clear()

        ' Add column series for monthly payments
        MPOverview.Series.Add(New ColumnSeries With {
        .Values = paymentValues,
        .Title = "Payments",
        .Fill = System.Windows.Media.Brushes.CornflowerBlue
    })

        ' Set up the X-axis with month labels
        MPOverview.AxisX.Clear()
        MPOverview.AxisX.Add(New Axis With {
        .Title = "Months",
        .Labels = monthLabels,
        .Separator = New Separator With {.Step = 1} ' Ensures labels for each month
    })

        ' Configure the Y-axis to display payment amounts in currency format with bold font style
        MPOverview.AxisY.Clear()
        MPOverview.AxisY.Add(New Axis With {
        .Title = "Total Cost",
        .LabelFormatter = Function(value) value.ToString("C"),
        .FontWeight = FontWeights.Bold ' Use FontWeights.Bold for bold text
    })

        ' Enable default legend
        MPOverview.LegendLocation = LegendLocation.Right
    End Sub
    'DONE DONE DONE DONE

    Private Sub YourFormName_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        LoadRecentBookings()
    End Sub
    Private connectionString As String = "server=mysql-nextgen.alwaysdata.net;database=nextgen_database;uid=nextgen;pwd=NextgenBikes@20242025;"

    Private Sub LoadRecentBookings()
        Dim query As String = "SELECT * FROM bookings ORDER BY booking_date DESC LIMIT 10" ' Adjust the query as needed
        Using conn As New MySqlConnection(connectionString)
            Try
                conn.Open()
                Dim cmd As New MySqlCommand(query, conn)
                Dim adapter As New MySqlDataAdapter(cmd)
                Dim dt As New DataTable()
                adapter.Fill(dt)

                ' Set the DataSource of the DataGridView
                DGVBookings.DataSource = dt
            Catch ex As Exception
                MessageBox.Show("Error loading recent bookings: " & ex.Message)
            End Try
        End Using
    End Sub
    Private Sub picBoxExit3_Click(sender As Object, e As EventArgs) Handles picBoxExit3.Click
        End ' Terminate the application
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

    Private Sub pbReviews_Click(sender As Object, e As EventArgs) Handles pbReviews.Click
        AdminReviews.Show()
        Me.Hide()
    End Sub


    Private Sub LogOut_Click(sender As Object, e As EventArgs) Handles dashboardlogout.Click
        Dim result As DialogResult = MessageBox.Show("Are you sure you want to log out?", "Log Out", MessageBoxButtons.YesNo)
        If result = DialogResult.Yes Then
            ' Show the login form and hide the admin dashboard
            Login.Show()
            Me.Hide()
        End If
    End Sub

End Class



