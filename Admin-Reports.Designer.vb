<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class AdminReports
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()>
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()>
    Private Sub InitializeComponent()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(AdminReports))
        Dim MessageBoxSettings1 As Syncfusion.Windows.Forms.PdfViewer.MessageBoxSettings = New Syncfusion.Windows.Forms.PdfViewer.MessageBoxSettings()
        Dim PdfViewerPrinterSettings1 As Syncfusion.Windows.PdfViewer.PdfViewerPrinterSettings = New Syncfusion.Windows.PdfViewer.PdfViewerPrinterSettings()
        Dim TextSearchSettings1 As Syncfusion.Windows.Forms.PdfViewer.TextSearchSettings = New Syncfusion.Windows.Forms.PdfViewer.TextSearchSettings()
        Me.logoutreports = New System.Windows.Forms.PictureBox()
        Me.pbReviews = New System.Windows.Forms.PictureBox()
        Me.pbBookings = New System.Windows.Forms.PictureBox()
        Me.pbSales = New System.Windows.Forms.PictureBox()
        Me.pbBikes = New System.Windows.Forms.PictureBox()
        Me.pbUsers = New System.Windows.Forms.PictureBox()
        Me.pbDash = New System.Windows.Forms.PictureBox()
        Me.PictureBox1 = New System.Windows.Forms.PictureBox()
        Me.dateTimePickerStart = New Guna.UI2.WinForms.Guna2DateTimePicker()
        Me.dateTimePickerEnd = New Guna.UI2.WinForms.Guna2DateTimePicker()
        Me.label = New System.Windows.Forms.Label()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.btnGenerateReport = New Guna.UI2.WinForms.Guna2Button()
        Me.syncfusionPdfViewer = New Syncfusion.Windows.Forms.PdfViewer.PdfViewerControl()
        Me.Guna2HtmlLabel1 = New Guna.UI2.WinForms.Guna2HtmlLabel()
        Me.backbutton2 = New System.Windows.Forms.PictureBox()
        CType(Me.logoutreports, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.pbReviews, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.pbBookings, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.pbSales, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.pbBikes, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.pbUsers, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.pbDash, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.backbutton2, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'logoutreports
        '
        Me.logoutreports.BackColor = System.Drawing.Color.Transparent
        Me.logoutreports.Image = CType(resources.GetObject("logoutreports.Image"), System.Drawing.Image)
        Me.logoutreports.Location = New System.Drawing.Point(26, 741)
        Me.logoutreports.Name = "logoutreports"
        Me.logoutreports.Size = New System.Drawing.Size(104, 62)
        Me.logoutreports.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.logoutreports.TabIndex = 26
        Me.logoutreports.TabStop = False
        '
        'pbReviews
        '
        Me.pbReviews.BackColor = System.Drawing.Color.Transparent
        Me.pbReviews.Image = CType(resources.GetObject("pbReviews.Image"), System.Drawing.Image)
        Me.pbReviews.Location = New System.Drawing.Point(26, 448)
        Me.pbReviews.Name = "pbReviews"
        Me.pbReviews.Size = New System.Drawing.Size(106, 62)
        Me.pbReviews.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.pbReviews.TabIndex = 25
        Me.pbReviews.TabStop = False
        '
        'pbBookings
        '
        Me.pbBookings.BackColor = System.Drawing.Color.Transparent
        Me.pbBookings.Image = CType(resources.GetObject("pbBookings.Image"), System.Drawing.Image)
        Me.pbBookings.Location = New System.Drawing.Point(26, 380)
        Me.pbBookings.Name = "pbBookings"
        Me.pbBookings.Size = New System.Drawing.Size(106, 62)
        Me.pbBookings.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.pbBookings.TabIndex = 24
        Me.pbBookings.TabStop = False
        '
        'pbSales
        '
        Me.pbSales.BackColor = System.Drawing.Color.Transparent
        Me.pbSales.Image = CType(resources.GetObject("pbSales.Image"), System.Drawing.Image)
        Me.pbSales.Location = New System.Drawing.Point(26, 312)
        Me.pbSales.Name = "pbSales"
        Me.pbSales.Size = New System.Drawing.Size(106, 62)
        Me.pbSales.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.pbSales.TabIndex = 23
        Me.pbSales.TabStop = False
        '
        'pbBikes
        '
        Me.pbBikes.BackColor = System.Drawing.Color.Transparent
        Me.pbBikes.Image = CType(resources.GetObject("pbBikes.Image"), System.Drawing.Image)
        Me.pbBikes.Location = New System.Drawing.Point(26, 176)
        Me.pbBikes.Name = "pbBikes"
        Me.pbBikes.Size = New System.Drawing.Size(106, 62)
        Me.pbBikes.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.pbBikes.TabIndex = 22
        Me.pbBikes.TabStop = False
        '
        'pbUsers
        '
        Me.pbUsers.BackColor = System.Drawing.Color.Transparent
        Me.pbUsers.Image = CType(resources.GetObject("pbUsers.Image"), System.Drawing.Image)
        Me.pbUsers.Location = New System.Drawing.Point(26, 244)
        Me.pbUsers.Name = "pbUsers"
        Me.pbUsers.Size = New System.Drawing.Size(106, 62)
        Me.pbUsers.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.pbUsers.TabIndex = 21
        Me.pbUsers.TabStop = False
        '
        'pbDash
        '
        Me.pbDash.BackColor = System.Drawing.Color.Transparent
        Me.pbDash.Image = CType(resources.GetObject("pbDash.Image"), System.Drawing.Image)
        Me.pbDash.Location = New System.Drawing.Point(26, 108)
        Me.pbDash.Name = "pbDash"
        Me.pbDash.Size = New System.Drawing.Size(106, 62)
        Me.pbDash.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.pbDash.TabIndex = 20
        Me.pbDash.TabStop = False
        '
        'PictureBox1
        '
        Me.PictureBox1.BackColor = System.Drawing.Color.Transparent
        Me.PictureBox1.Image = CType(resources.GetObject("PictureBox1.Image"), System.Drawing.Image)
        Me.PictureBox1.Location = New System.Drawing.Point(26, 18)
        Me.PictureBox1.Name = "PictureBox1"
        Me.PictureBox1.Size = New System.Drawing.Size(106, 72)
        Me.PictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.PictureBox1.TabIndex = 18
        Me.PictureBox1.TabStop = False
        '
        'dateTimePickerStart
        '
        Me.dateTimePickerStart.Checked = True
        Me.dateTimePickerStart.FillColor = System.Drawing.Color.DarkGreen
        Me.dateTimePickerStart.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.dateTimePickerStart.Format = System.Windows.Forms.DateTimePickerFormat.[Long]
        Me.dateTimePickerStart.Location = New System.Drawing.Point(467, 119)
        Me.dateTimePickerStart.MaxDate = New Date(9998, 12, 31, 0, 0, 0, 0)
        Me.dateTimePickerStart.MinDate = New Date(1753, 1, 1, 0, 0, 0, 0)
        Me.dateTimePickerStart.Name = "dateTimePickerStart"
        Me.dateTimePickerStart.Size = New System.Drawing.Size(218, 32)
        Me.dateTimePickerStart.TabIndex = 32
        Me.dateTimePickerStart.Value = New Date(2024, 10, 30, 17, 32, 46, 85)
        '
        'dateTimePickerEnd
        '
        Me.dateTimePickerEnd.Checked = True
        Me.dateTimePickerEnd.FillColor = System.Drawing.Color.DarkGreen
        Me.dateTimePickerEnd.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.dateTimePickerEnd.Format = System.Windows.Forms.DateTimePickerFormat.[Long]
        Me.dateTimePickerEnd.Location = New System.Drawing.Point(763, 118)
        Me.dateTimePickerEnd.MaxDate = New Date(9998, 12, 31, 0, 0, 0, 0)
        Me.dateTimePickerEnd.MinDate = New Date(1753, 1, 1, 0, 0, 0, 0)
        Me.dateTimePickerEnd.Name = "dateTimePickerEnd"
        Me.dateTimePickerEnd.Size = New System.Drawing.Size(249, 33)
        Me.dateTimePickerEnd.TabIndex = 32
        Me.dateTimePickerEnd.Value = New Date(2024, 10, 30, 17, 32, 46, 85)
        '
        'label
        '
        Me.label.AutoSize = True
        Me.label.BackColor = System.Drawing.Color.Transparent
        Me.label.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.label.Location = New System.Drawing.Point(199, 176)
        Me.label.Name = "label"
        Me.label.Size = New System.Drawing.Size(83, 18)
        Me.label.TabIndex = 95
        Me.label.Text = "Generate"
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.BackColor = System.Drawing.Color.Transparent
        Me.Label1.Font = New System.Drawing.Font("Aloevera-Regular", 20.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label1.Location = New System.Drawing.Point(714, 120)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(43, 31)
        Me.Label1.TabIndex = 96
        Me.Label1.Text = "to"
        '
        'btnGenerateReport
        '
        Me.btnGenerateReport.AutoRoundedCorners = True
        Me.btnGenerateReport.BorderRadius = 14
        Me.btnGenerateReport.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.btnGenerateReport.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.btnGenerateReport.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.btnGenerateReport.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.btnGenerateReport.FillColor = System.Drawing.Color.Green
        Me.btnGenerateReport.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.btnGenerateReport.ForeColor = System.Drawing.Color.White
        Me.btnGenerateReport.Location = New System.Drawing.Point(787, 157)
        Me.btnGenerateReport.Name = "btnGenerateReport"
        Me.btnGenerateReport.Size = New System.Drawing.Size(225, 31)
        Me.btnGenerateReport.TabIndex = 97
        Me.btnGenerateReport.Text = "Generate"
        '
        'syncfusionPdfViewer
        '
        Me.syncfusionPdfViewer.CursorMode = Syncfusion.Windows.Forms.PdfViewer.PdfViewerCursorMode.SelectTool
        Me.syncfusionPdfViewer.EnableContextMenu = True
        Me.syncfusionPdfViewer.EnableNotificationBar = True
        Me.syncfusionPdfViewer.HorizontalScrollOffset = 0
        Me.syncfusionPdfViewer.IsBookmarkEnabled = True
        Me.syncfusionPdfViewer.IsTextSearchEnabled = True
        Me.syncfusionPdfViewer.IsTextSelectionEnabled = True
        Me.syncfusionPdfViewer.Location = New System.Drawing.Point(193, 203)
        MessageBoxSettings1.EnableNotification = True
        Me.syncfusionPdfViewer.MessageBoxSettings = MessageBoxSettings1
        Me.syncfusionPdfViewer.MinimumZoomPercentage = 50
        Me.syncfusionPdfViewer.Name = "syncfusionPdfViewer"
        Me.syncfusionPdfViewer.PageBorderThickness = 1
        PdfViewerPrinterSettings1.Copies = 1
        PdfViewerPrinterSettings1.PageOrientation = Syncfusion.Windows.PdfViewer.PdfViewerPrintOrientation.[Auto]
        PdfViewerPrinterSettings1.PageSize = Syncfusion.Windows.PdfViewer.PdfViewerPrintSize.ActualSize
        PdfViewerPrinterSettings1.PrintLocation = CType(resources.GetObject("PdfViewerPrinterSettings1.PrintLocation"), System.Drawing.PointF)
        PdfViewerPrinterSettings1.ShowPrintStatusDialog = True
        Me.syncfusionPdfViewer.PrinterSettings = PdfViewerPrinterSettings1
        Me.syncfusionPdfViewer.ReferencePath = Nothing
        Me.syncfusionPdfViewer.ScrollDisplacementValue = 0
        Me.syncfusionPdfViewer.ShowHorizontalScrollBar = True
        Me.syncfusionPdfViewer.ShowToolBar = True
        Me.syncfusionPdfViewer.ShowVerticalScrollBar = True
        Me.syncfusionPdfViewer.Size = New System.Drawing.Size(825, 530)
        Me.syncfusionPdfViewer.SpaceBetweenPages = 8
        Me.syncfusionPdfViewer.TabIndex = 98
        Me.syncfusionPdfViewer.Text = "PdfViewerControl1"
        TextSearchSettings1.CurrentInstanceColor = System.Drawing.Color.FromArgb(CType(CType(127, Byte), Integer), CType(CType(255, Byte), Integer), CType(CType(171, Byte), Integer), CType(CType(64, Byte), Integer))
        TextSearchSettings1.HighlightAllInstance = True
        TextSearchSettings1.OtherInstanceColor = System.Drawing.Color.FromArgb(CType(CType(127, Byte), Integer), CType(CType(254, Byte), Integer), CType(CType(255, Byte), Integer), CType(CType(0, Byte), Integer))
        Me.syncfusionPdfViewer.TextSearchSettings = TextSearchSettings1
        Me.syncfusionPdfViewer.ThemeName = "Default"
        Me.syncfusionPdfViewer.VerticalScrollOffset = 0
        Me.syncfusionPdfViewer.VisualStyle = Syncfusion.Windows.Forms.PdfViewer.VisualStyle.[Default]
        Me.syncfusionPdfViewer.ZoomMode = Syncfusion.Windows.Forms.PdfViewer.ZoomMode.[Default]
        '
        'Guna2HtmlLabel1
        '
        Me.Guna2HtmlLabel1.BackColor = System.Drawing.Color.Transparent
        Me.Guna2HtmlLabel1.Font = New System.Drawing.Font("Aloevera-Regular", 20.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Guna2HtmlLabel1.Location = New System.Drawing.Point(193, 118)
        Me.Guna2HtmlLabel1.Name = "Guna2HtmlLabel1"
        Me.Guna2HtmlLabel1.Size = New System.Drawing.Size(222, 33)
        Me.Guna2HtmlLabel1.TabIndex = 99
        Me.Guna2HtmlLabel1.Text = "Generate Report" & Global.Microsoft.VisualBasic.ChrW(13) & Global.Microsoft.VisualBasic.ChrW(10)
        '
        'backbutton2
        '
        Me.backbutton2.BackColor = System.Drawing.Color.Transparent
        Me.backbutton2.Image = CType(resources.GetObject("backbutton2.Image"), System.Drawing.Image)
        Me.backbutton2.InitialImage = Nothing
        Me.backbutton2.Location = New System.Drawing.Point(1008, 12)
        Me.backbutton2.Name = "backbutton2"
        Me.backbutton2.Size = New System.Drawing.Size(44, 43)
        Me.backbutton2.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.backbutton2.TabIndex = 101
        Me.backbutton2.TabStop = False
        '
        'AdminReports
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.AutoScroll = True
        Me.BackgroundImage = CType(resources.GetObject("$this.BackgroundImage"), System.Drawing.Image)
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1064, 828)
        Me.Controls.Add(Me.backbutton2)
        Me.Controls.Add(Me.Guna2HtmlLabel1)
        Me.Controls.Add(Me.syncfusionPdfViewer)
        Me.Controls.Add(Me.btnGenerateReport)
        Me.Controls.Add(Me.Label1)
        Me.Controls.Add(Me.label)
        Me.Controls.Add(Me.dateTimePickerEnd)
        Me.Controls.Add(Me.dateTimePickerStart)
        Me.Controls.Add(Me.logoutreports)
        Me.Controls.Add(Me.pbReviews)
        Me.Controls.Add(Me.pbBookings)
        Me.Controls.Add(Me.pbSales)
        Me.Controls.Add(Me.pbBikes)
        Me.Controls.Add(Me.pbUsers)
        Me.Controls.Add(Me.pbDash)
        Me.Controls.Add(Me.PictureBox1)
        Me.DoubleBuffered = True
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Icon = CType(resources.GetObject("$this.Icon"), System.Drawing.Icon)
        Me.Name = "AdminReports"
        Me.ShowInTaskbar = False
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "NextGen AOR | Reports"
        CType(Me.logoutreports, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.pbReviews, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.pbBookings, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.pbSales, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.pbBikes, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.pbUsers, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.pbDash, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.backbutton2, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub

    Friend WithEvents logoutreports As PictureBox
    Friend WithEvents pbReviews As PictureBox
    Friend WithEvents pbBookings As PictureBox
    Friend WithEvents pbSales As PictureBox
    Friend WithEvents pbBikes As PictureBox
    Friend WithEvents pbUsers As PictureBox
    Friend WithEvents pbDash As PictureBox
    Friend WithEvents PictureBox1 As PictureBox
    Friend WithEvents dateTimePickerStart As Guna.UI2.WinForms.Guna2DateTimePicker
    Friend WithEvents dateTimePickerEnd As Guna.UI2.WinForms.Guna2DateTimePicker
    Friend WithEvents label As Label
    Friend WithEvents Label1 As Label
    Friend WithEvents btnGenerateReport As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents syncfusionPdfViewer As Syncfusion.Windows.Forms.PdfViewer.PdfViewerControl
    Friend WithEvents Guna2HtmlLabel1 As Guna.UI2.WinForms.Guna2HtmlLabel
    Friend WithEvents backbutton2 As PictureBox
End Class
