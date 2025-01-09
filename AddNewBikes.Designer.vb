<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class AddNewBikes
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
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
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(AddNewBikes))
        Me.Label13 = New System.Windows.Forms.Label()
        Me.Label15 = New System.Windows.Forms.Label()
        Me.Label12 = New System.Windows.Forms.Label()
        Me.Label14 = New System.Windows.Forms.Label()
        Me.Label16 = New System.Windows.Forms.Label()
        Me.Label17 = New System.Windows.Forms.Label()
        Me.Label9 = New System.Windows.Forms.Label()
        Me.Label10 = New System.Windows.Forms.Label()
        Me.Label11 = New System.Windows.Forms.Label()
        Me.Label18 = New System.Windows.Forms.Label()
        Me.Label19 = New System.Windows.Forms.Label()
        Me.Label20 = New System.Windows.Forms.Label()
        Me.Label21 = New System.Windows.Forms.Label()
        Me.Label22 = New System.Windows.Forms.Label()
        Me.PictureBox2 = New System.Windows.Forms.PictureBox()
        Me.backbutton = New System.Windows.Forms.PictureBox()
        Me.cmbCategory = New Guna.UI2.WinForms.Guna2ComboBox()
        Me.txtBikeName = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtBikeBrand = New Guna.UI2.WinForms.Guna2TextBox()
        Me.Guna2TextBox3 = New Guna.UI2.WinForms.Guna2TextBox()
        Me.cmbAvailabilityStatus = New Guna.UI2.WinForms.Guna2ComboBox()
        Me.btnSelectImage = New Guna.UI2.WinForms.Guna2Button()
        Me.txtImageFileName = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtMetaTitle = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtMetaDescription = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtSlug1 = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtHourlyRate = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtDailyRate = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtBikeSize = New Guna.UI2.WinForms.Guna2TextBox()
        Me.numQuantity = New Guna.UI2.WinForms.Guna2NumericUpDown()
        Me.txtMetaKeywords = New Guna.UI2.WinForms.Guna2TextBox()
        Me.chkHidden = New Guna.UI2.WinForms.Guna2CheckBox()
        Me.chkAvailable = New Guna.UI2.WinForms.Guna2CheckBox()
        Me.btnSave = New Guna.UI2.WinForms.Guna2Button()
        CType(Me.PictureBox2, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.backbutton, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.numQuantity, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'Label13
        '
        Me.Label13.AutoSize = True
        Me.Label13.BackColor = System.Drawing.Color.Transparent
        Me.Label13.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label13.Location = New System.Drawing.Point(354, 582)
        Me.Label13.Name = "Label13"
        Me.Label13.Size = New System.Drawing.Size(139, 18)
        Me.Label13.TabIndex = 26
        Me.Label13.Text = "Meta Description"
        '
        'Label15
        '
        Me.Label15.AutoSize = True
        Me.Label15.BackColor = System.Drawing.Color.Transparent
        Me.Label15.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label15.Location = New System.Drawing.Point(354, 512)
        Me.Label15.Name = "Label15"
        Me.Label15.Size = New System.Drawing.Size(83, 18)
        Me.Label15.TabIndex = 33
        Me.Label15.Text = "Meta Title"
        '
        'Label12
        '
        Me.Label12.AutoSize = True
        Me.Label12.BackColor = System.Drawing.Color.Transparent
        Me.Label12.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label12.Location = New System.Drawing.Point(828, 439)
        Me.Label12.Name = "Label12"
        Me.Label12.Size = New System.Drawing.Size(130, 18)
        Me.Label12.TabIndex = 34
        Me.Label12.Text = "Meta Keywords"
        '
        'Label14
        '
        Me.Label14.AutoSize = True
        Me.Label14.BackColor = System.Drawing.Color.Transparent
        Me.Label14.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label14.Location = New System.Drawing.Point(358, 449)
        Me.Label14.Name = "Label14"
        Me.Label14.Size = New System.Drawing.Size(56, 18)
        Me.Label14.TabIndex = 35
        Me.Label14.Text = "Image"
        '
        'Label16
        '
        Me.Label16.AutoSize = True
        Me.Label16.BackColor = System.Drawing.Color.Transparent
        Me.Label16.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label16.Location = New System.Drawing.Point(357, 377)
        Me.Label16.Name = "Label16"
        Me.Label16.Size = New System.Drawing.Size(146, 18)
        Me.Label16.TabIndex = 36
        Me.Label16.Text = "Availability Status"
        '
        'Label17
        '
        Me.Label17.AutoSize = True
        Me.Label17.BackColor = System.Drawing.Color.Transparent
        Me.Label17.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label17.Location = New System.Drawing.Point(828, 363)
        Me.Label17.Name = "Label17"
        Me.Label17.Size = New System.Drawing.Size(76, 18)
        Me.Label17.TabIndex = 37
        Me.Label17.Text = "Quantity"
        '
        'Label9
        '
        Me.Label9.AutoSize = True
        Me.Label9.BackColor = System.Drawing.Color.Transparent
        Me.Label9.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label9.Location = New System.Drawing.Point(354, 294)
        Me.Label9.Name = "Label9"
        Me.Label9.Size = New System.Drawing.Size(131, 18)
        Me.Label9.TabIndex = 38
        Me.Label9.Text = "Bike Description"
        '
        'Label10
        '
        Me.Label10.AutoSize = True
        Me.Label10.BackColor = System.Drawing.Color.Transparent
        Me.Label10.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label10.Location = New System.Drawing.Point(358, 238)
        Me.Label10.Name = "Label10"
        Me.Label10.Size = New System.Drawing.Size(97, 18)
        Me.Label10.TabIndex = 39
        Me.Label10.Text = "Bike Brands"
        '
        'Label11
        '
        Me.Label11.AutoSize = True
        Me.Label11.BackColor = System.Drawing.Color.Transparent
        Me.Label11.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label11.Location = New System.Drawing.Point(358, 170)
        Me.Label11.Name = "Label11"
        Me.Label11.Size = New System.Drawing.Size(96, 18)
        Me.Label11.TabIndex = 40
        Me.Label11.Text = "Bike Names"
        '
        'Label18
        '
        Me.Label18.AutoSize = True
        Me.Label18.BackColor = System.Drawing.Color.Transparent
        Me.Label18.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label18.Location = New System.Drawing.Point(821, 294)
        Me.Label18.Name = "Label18"
        Me.Label18.Size = New System.Drawing.Size(234, 18)
        Me.Label18.TabIndex = 41
        Me.Label18.Text = "Bike Size (e.g., 175 cm - 185 cm)"
        '
        'Label19
        '
        Me.Label19.AutoSize = True
        Me.Label19.BackColor = System.Drawing.Color.Transparent
        Me.Label19.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label19.Location = New System.Drawing.Point(824, 232)
        Me.Label19.Name = "Label19"
        Me.Label19.Size = New System.Drawing.Size(202, 18)
        Me.Label19.TabIndex = 42
        Me.Label19.Text = "Daily Rate (Price per Day)"
        '
        'Label20
        '
        Me.Label20.AutoSize = True
        Me.Label20.BackColor = System.Drawing.Color.Transparent
        Me.Label20.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label20.Location = New System.Drawing.Point(821, 170)
        Me.Label20.Name = "Label20"
        Me.Label20.Size = New System.Drawing.Size(219, 18)
        Me.Label20.TabIndex = 43
        Me.Label20.Text = "Hourly Rate (Price per Hour)"
        '
        'Label21
        '
        Me.Label21.AutoSize = True
        Me.Label21.BackColor = System.Drawing.Color.Transparent
        Me.Label21.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label21.Location = New System.Drawing.Point(828, 103)
        Me.Label21.Name = "Label21"
        Me.Label21.Size = New System.Drawing.Size(39, 18)
        Me.Label21.TabIndex = 44
        Me.Label21.Text = "Slug"
        '
        'Label22
        '
        Me.Label22.AutoSize = True
        Me.Label22.BackColor = System.Drawing.Color.Transparent
        Me.Label22.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label22.Location = New System.Drawing.Point(357, 103)
        Me.Label22.Name = "Label22"
        Me.Label22.Size = New System.Drawing.Size(136, 18)
        Me.Label22.TabIndex = 45
        Me.Label22.Text = "Select Category"
        '
        'PictureBox2
        '
        Me.PictureBox2.BackColor = System.Drawing.Color.Transparent
        Me.PictureBox2.Image = CType(resources.GetObject("PictureBox2.Image"), System.Drawing.Image)
        Me.PictureBox2.Location = New System.Drawing.Point(41, 195)
        Me.PictureBox2.Name = "PictureBox2"
        Me.PictureBox2.Size = New System.Drawing.Size(131, 55)
        Me.PictureBox2.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.PictureBox2.TabIndex = 47
        Me.PictureBox2.TabStop = False
        '
        'backbutton
        '
        Me.backbutton.BackColor = System.Drawing.Color.Transparent
        Me.backbutton.ErrorImage = Nothing
        Me.backbutton.Image = CType(resources.GetObject("backbutton.Image"), System.Drawing.Image)
        Me.backbutton.InitialImage = Nothing
        Me.backbutton.Location = New System.Drawing.Point(1208, 27)
        Me.backbutton.Name = "backbutton"
        Me.backbutton.Size = New System.Drawing.Size(42, 43)
        Me.backbutton.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.backbutton.TabIndex = 46
        Me.backbutton.TabStop = False
        '
        'cmbCategory
        '
        Me.cmbCategory.AutoRoundedCorners = True
        Me.cmbCategory.BackColor = System.Drawing.Color.Transparent
        Me.cmbCategory.BorderRadius = 17
        Me.cmbCategory.DrawMode = System.Windows.Forms.DrawMode.OwnerDrawFixed
        Me.cmbCategory.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList
        Me.cmbCategory.FocusedColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.cmbCategory.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.cmbCategory.Font = New System.Drawing.Font("Segoe UI", 10.0!)
        Me.cmbCategory.ForeColor = System.Drawing.Color.FromArgb(CType(CType(68, Byte), Integer), CType(CType(88, Byte), Integer), CType(CType(112, Byte), Integer))
        Me.cmbCategory.ItemHeight = 30
        Me.cmbCategory.Location = New System.Drawing.Point(354, 124)
        Me.cmbCategory.Name = "cmbCategory"
        Me.cmbCategory.Size = New System.Drawing.Size(221, 36)
        Me.cmbCategory.TabIndex = 48
        '
        'txtBikeName
        '
        Me.txtBikeName.AutoRoundedCorners = True
        Me.txtBikeName.BackColor = System.Drawing.Color.Transparent
        Me.txtBikeName.BorderRadius = 14
        Me.txtBikeName.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtBikeName.DefaultText = ""
        Me.txtBikeName.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtBikeName.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtBikeName.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtBikeName.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtBikeName.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtBikeName.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtBikeName.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtBikeName.Location = New System.Drawing.Point(355, 191)
        Me.txtBikeName.Name = "txtBikeName"
        Me.txtBikeName.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtBikeName.PlaceholderText = ""
        Me.txtBikeName.SelectedText = ""
        Me.txtBikeName.Size = New System.Drawing.Size(220, 31)
        Me.txtBikeName.TabIndex = 49
        '
        'txtBikeBrand
        '
        Me.txtBikeBrand.AutoRoundedCorners = True
        Me.txtBikeBrand.BackColor = System.Drawing.Color.Transparent
        Me.txtBikeBrand.BorderRadius = 14
        Me.txtBikeBrand.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtBikeBrand.DefaultText = ""
        Me.txtBikeBrand.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtBikeBrand.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtBikeBrand.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtBikeBrand.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtBikeBrand.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtBikeBrand.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtBikeBrand.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtBikeBrand.Location = New System.Drawing.Point(355, 259)
        Me.txtBikeBrand.Name = "txtBikeBrand"
        Me.txtBikeBrand.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtBikeBrand.PlaceholderText = ""
        Me.txtBikeBrand.SelectedText = ""
        Me.txtBikeBrand.Size = New System.Drawing.Size(220, 31)
        Me.txtBikeBrand.TabIndex = 50
        '
        'Guna2TextBox3
        '
        Me.Guna2TextBox3.AutoRoundedCorners = True
        Me.Guna2TextBox3.BackColor = System.Drawing.Color.Transparent
        Me.Guna2TextBox3.BorderRadius = 21
        Me.Guna2TextBox3.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.Guna2TextBox3.DefaultText = ""
        Me.Guna2TextBox3.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.Guna2TextBox3.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.Guna2TextBox3.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.Guna2TextBox3.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.Guna2TextBox3.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.Guna2TextBox3.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.Guna2TextBox3.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.Guna2TextBox3.Location = New System.Drawing.Point(355, 315)
        Me.Guna2TextBox3.Name = "Guna2TextBox3"
        Me.Guna2TextBox3.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.Guna2TextBox3.PlaceholderText = ""
        Me.Guna2TextBox3.SelectedText = ""
        Me.Guna2TextBox3.Size = New System.Drawing.Size(220, 45)
        Me.Guna2TextBox3.TabIndex = 51
        '
        'cmbAvailabilityStatus
        '
        Me.cmbAvailabilityStatus.AutoRoundedCorners = True
        Me.cmbAvailabilityStatus.BackColor = System.Drawing.Color.Transparent
        Me.cmbAvailabilityStatus.BorderRadius = 17
        Me.cmbAvailabilityStatus.DrawMode = System.Windows.Forms.DrawMode.OwnerDrawFixed
        Me.cmbAvailabilityStatus.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList
        Me.cmbAvailabilityStatus.FocusedColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.cmbAvailabilityStatus.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.cmbAvailabilityStatus.Font = New System.Drawing.Font("Segoe UI", 10.0!)
        Me.cmbAvailabilityStatus.ForeColor = System.Drawing.Color.FromArgb(CType(CType(68, Byte), Integer), CType(CType(88, Byte), Integer), CType(CType(112, Byte), Integer))
        Me.cmbAvailabilityStatus.ItemHeight = 30
        Me.cmbAvailabilityStatus.Location = New System.Drawing.Point(357, 398)
        Me.cmbAvailabilityStatus.Name = "cmbAvailabilityStatus"
        Me.cmbAvailabilityStatus.Size = New System.Drawing.Size(221, 36)
        Me.cmbAvailabilityStatus.TabIndex = 52
        '
        'btnSelectImage
        '
        Me.btnSelectImage.AutoRoundedCorners = True
        Me.btnSelectImage.BackColor = System.Drawing.Color.Transparent
        Me.btnSelectImage.BorderRadius = 12
        Me.btnSelectImage.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.btnSelectImage.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.btnSelectImage.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.btnSelectImage.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.btnSelectImage.FillColor = System.Drawing.Color.DarkGray
        Me.btnSelectImage.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.btnSelectImage.ForeColor = System.Drawing.Color.Black
        Me.btnSelectImage.Location = New System.Drawing.Point(354, 476)
        Me.btnSelectImage.Name = "btnSelectImage"
        Me.btnSelectImage.Size = New System.Drawing.Size(92, 27)
        Me.btnSelectImage.TabIndex = 53
        Me.btnSelectImage.Text = "Choose File"
        '
        'txtImageFileName
        '
        Me.txtImageFileName.AutoRoundedCorners = True
        Me.txtImageFileName.BackColor = System.Drawing.Color.Transparent
        Me.txtImageFileName.BorderRadius = 14
        Me.txtImageFileName.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtImageFileName.DefaultText = ""
        Me.txtImageFileName.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtImageFileName.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtImageFileName.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtImageFileName.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtImageFileName.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtImageFileName.Font = New System.Drawing.Font("Segoe UI", 9.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.txtImageFileName.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtImageFileName.Location = New System.Drawing.Point(451, 476)
        Me.txtImageFileName.Name = "txtImageFileName"
        Me.txtImageFileName.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtImageFileName.PlaceholderText = ""
        Me.txtImageFileName.SelectedText = ""
        Me.txtImageFileName.Size = New System.Drawing.Size(121, 31)
        Me.txtImageFileName.TabIndex = 54
        '
        'txtMetaTitle
        '
        Me.txtMetaTitle.AutoRoundedCorners = True
        Me.txtMetaTitle.BackColor = System.Drawing.Color.Transparent
        Me.txtMetaTitle.BorderRadius = 14
        Me.txtMetaTitle.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtMetaTitle.DefaultText = ""
        Me.txtMetaTitle.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtMetaTitle.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtMetaTitle.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaTitle.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaTitle.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaTitle.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtMetaTitle.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaTitle.Location = New System.Drawing.Point(357, 533)
        Me.txtMetaTitle.Name = "txtMetaTitle"
        Me.txtMetaTitle.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaTitle.PlaceholderText = ""
        Me.txtMetaTitle.SelectedText = ""
        Me.txtMetaTitle.Size = New System.Drawing.Size(220, 31)
        Me.txtMetaTitle.TabIndex = 55
        '
        'txtMetaDescription
        '
        Me.txtMetaDescription.AutoRoundedCorners = True
        Me.txtMetaDescription.BackColor = System.Drawing.Color.Transparent
        Me.txtMetaDescription.BorderRadius = 14
        Me.txtMetaDescription.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtMetaDescription.DefaultText = ""
        Me.txtMetaDescription.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtMetaDescription.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtMetaDescription.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaDescription.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaDescription.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaDescription.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtMetaDescription.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaDescription.Location = New System.Drawing.Point(355, 605)
        Me.txtMetaDescription.Name = "txtMetaDescription"
        Me.txtMetaDescription.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaDescription.PlaceholderText = ""
        Me.txtMetaDescription.SelectedText = ""
        Me.txtMetaDescription.Size = New System.Drawing.Size(220, 31)
        Me.txtMetaDescription.TabIndex = 56
        '
        'txtSlug1
        '
        Me.txtSlug1.AutoRoundedCorners = True
        Me.txtSlug1.BackColor = System.Drawing.Color.Transparent
        Me.txtSlug1.BorderRadius = 14
        Me.txtSlug1.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtSlug1.DefaultText = ""
        Me.txtSlug1.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtSlug1.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtSlug1.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtSlug1.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtSlug1.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtSlug1.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtSlug1.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtSlug1.Location = New System.Drawing.Point(824, 124)
        Me.txtSlug1.Name = "txtSlug1"
        Me.txtSlug1.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtSlug1.PlaceholderText = ""
        Me.txtSlug1.SelectedText = ""
        Me.txtSlug1.Size = New System.Drawing.Size(220, 31)
        Me.txtSlug1.TabIndex = 57
        '
        'txtHourlyRate
        '
        Me.txtHourlyRate.AutoRoundedCorners = True
        Me.txtHourlyRate.BackColor = System.Drawing.Color.Transparent
        Me.txtHourlyRate.BorderRadius = 14
        Me.txtHourlyRate.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtHourlyRate.DefaultText = ""
        Me.txtHourlyRate.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtHourlyRate.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtHourlyRate.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtHourlyRate.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtHourlyRate.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtHourlyRate.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtHourlyRate.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtHourlyRate.Location = New System.Drawing.Point(824, 195)
        Me.txtHourlyRate.Name = "txtHourlyRate"
        Me.txtHourlyRate.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtHourlyRate.PlaceholderText = ""
        Me.txtHourlyRate.SelectedText = ""
        Me.txtHourlyRate.Size = New System.Drawing.Size(220, 31)
        Me.txtHourlyRate.TabIndex = 58
        '
        'txtDailyRate
        '
        Me.txtDailyRate.AutoRoundedCorners = True
        Me.txtDailyRate.BackColor = System.Drawing.Color.Transparent
        Me.txtDailyRate.BorderRadius = 14
        Me.txtDailyRate.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtDailyRate.DefaultText = ""
        Me.txtDailyRate.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtDailyRate.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtDailyRate.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtDailyRate.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtDailyRate.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtDailyRate.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtDailyRate.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtDailyRate.Location = New System.Drawing.Point(824, 253)
        Me.txtDailyRate.Name = "txtDailyRate"
        Me.txtDailyRate.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtDailyRate.PlaceholderText = ""
        Me.txtDailyRate.SelectedText = ""
        Me.txtDailyRate.Size = New System.Drawing.Size(220, 31)
        Me.txtDailyRate.TabIndex = 59
        '
        'txtBikeSize
        '
        Me.txtBikeSize.AutoRoundedCorners = True
        Me.txtBikeSize.BackColor = System.Drawing.Color.Transparent
        Me.txtBikeSize.BorderRadius = 14
        Me.txtBikeSize.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtBikeSize.DefaultText = ""
        Me.txtBikeSize.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtBikeSize.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtBikeSize.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtBikeSize.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtBikeSize.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtBikeSize.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtBikeSize.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtBikeSize.Location = New System.Drawing.Point(824, 315)
        Me.txtBikeSize.Name = "txtBikeSize"
        Me.txtBikeSize.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtBikeSize.PlaceholderText = ""
        Me.txtBikeSize.SelectedText = ""
        Me.txtBikeSize.Size = New System.Drawing.Size(220, 31)
        Me.txtBikeSize.TabIndex = 60
        '
        'numQuantity
        '
        Me.numQuantity.AutoRoundedCorners = True
        Me.numQuantity.BackColor = System.Drawing.Color.Transparent
        Me.numQuantity.BorderRadius = 16
        Me.numQuantity.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.numQuantity.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.numQuantity.Location = New System.Drawing.Point(827, 384)
        Me.numQuantity.Name = "numQuantity"
        Me.numQuantity.Size = New System.Drawing.Size(107, 34)
        Me.numQuantity.TabIndex = 61
        Me.numQuantity.UpDownButtonFillColor = System.Drawing.Color.Silver
        Me.numQuantity.UpDownButtonForeColor = System.Drawing.Color.Black
        '
        'txtMetaKeywords
        '
        Me.txtMetaKeywords.AutoRoundedCorners = True
        Me.txtMetaKeywords.BackColor = System.Drawing.Color.Transparent
        Me.txtMetaKeywords.BorderRadius = 22
        Me.txtMetaKeywords.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtMetaKeywords.DefaultText = ""
        Me.txtMetaKeywords.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtMetaKeywords.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtMetaKeywords.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaKeywords.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaKeywords.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaKeywords.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtMetaKeywords.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaKeywords.Location = New System.Drawing.Point(824, 460)
        Me.txtMetaKeywords.Name = "txtMetaKeywords"
        Me.txtMetaKeywords.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaKeywords.PlaceholderText = ""
        Me.txtMetaKeywords.SelectedText = ""
        Me.txtMetaKeywords.Size = New System.Drawing.Size(220, 47)
        Me.txtMetaKeywords.TabIndex = 62
        '
        'chkHidden
        '
        Me.chkHidden.AutoSize = True
        Me.chkHidden.BackColor = System.Drawing.Color.Transparent
        Me.chkHidden.CheckedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkHidden.CheckedState.BorderRadius = 0
        Me.chkHidden.CheckedState.BorderThickness = 0
        Me.chkHidden.CheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkHidden.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!)
        Me.chkHidden.Location = New System.Drawing.Point(512, 661)
        Me.chkHidden.Name = "chkHidden"
        Me.chkHidden.Size = New System.Drawing.Size(60, 17)
        Me.chkHidden.TabIndex = 63
        Me.chkHidden.Text = "Hidden"
        Me.chkHidden.UncheckedState.BorderColor = System.Drawing.Color.Transparent
        Me.chkHidden.UncheckedState.BorderRadius = 0
        Me.chkHidden.UncheckedState.BorderThickness = 0
        Me.chkHidden.UncheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(125, Byte), Integer), CType(CType(137, Byte), Integer), CType(CType(149, Byte), Integer))
        Me.chkHidden.UseVisualStyleBackColor = False
        '
        'chkAvailable
        '
        Me.chkAvailable.AutoSize = True
        Me.chkAvailable.BackColor = System.Drawing.Color.Transparent
        Me.chkAvailable.CheckedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkAvailable.CheckedState.BorderRadius = 0
        Me.chkAvailable.CheckedState.BorderThickness = 0
        Me.chkAvailable.CheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkAvailable.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!)
        Me.chkAvailable.Location = New System.Drawing.Point(855, 661)
        Me.chkAvailable.Name = "chkAvailable"
        Me.chkAvailable.Size = New System.Drawing.Size(69, 17)
        Me.chkAvailable.TabIndex = 64
        Me.chkAvailable.Text = "Available"
        Me.chkAvailable.UncheckedState.BorderColor = System.Drawing.Color.Transparent
        Me.chkAvailable.UncheckedState.BorderRadius = 0
        Me.chkAvailable.UncheckedState.BorderThickness = 0
        Me.chkAvailable.UncheckedState.FillColor = System.Drawing.Color.White
        Me.chkAvailable.UseVisualStyleBackColor = False
        '
        'btnSave
        '
        Me.btnSave.AutoRoundedCorners = True
        Me.btnSave.BackColor = System.Drawing.Color.Transparent
        Me.btnSave.BorderRadius = 21
        Me.btnSave.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.btnSave.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.btnSave.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.btnSave.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.btnSave.FillColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(64, Byte), Integer), CType(CType(0, Byte), Integer))
        Me.btnSave.Font = New System.Drawing.Font("Aloevera-Regular", 9.749999!, System.Drawing.FontStyle.Bold)
        Me.btnSave.ForeColor = System.Drawing.Color.White
        Me.btnSave.Location = New System.Drawing.Point(620, 691)
        Me.btnSave.Name = "btnSave"
        Me.btnSave.Size = New System.Drawing.Size(180, 45)
        Me.btnSave.TabIndex = 65
        Me.btnSave.Text = "Saved"
        '
        'AddNewBikes
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = CType(resources.GetObject("$this.BackgroundImage"), System.Drawing.Image)
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1300, 781)
        Me.Controls.Add(Me.btnSave)
        Me.Controls.Add(Me.chkAvailable)
        Me.Controls.Add(Me.chkHidden)
        Me.Controls.Add(Me.txtMetaKeywords)
        Me.Controls.Add(Me.numQuantity)
        Me.Controls.Add(Me.txtBikeSize)
        Me.Controls.Add(Me.txtDailyRate)
        Me.Controls.Add(Me.txtHourlyRate)
        Me.Controls.Add(Me.txtSlug1)
        Me.Controls.Add(Me.txtMetaDescription)
        Me.Controls.Add(Me.txtMetaTitle)
        Me.Controls.Add(Me.txtImageFileName)
        Me.Controls.Add(Me.btnSelectImage)
        Me.Controls.Add(Me.cmbAvailabilityStatus)
        Me.Controls.Add(Me.Guna2TextBox3)
        Me.Controls.Add(Me.txtBikeBrand)
        Me.Controls.Add(Me.txtBikeName)
        Me.Controls.Add(Me.cmbCategory)
        Me.Controls.Add(Me.PictureBox2)
        Me.Controls.Add(Me.backbutton)
        Me.Controls.Add(Me.Label22)
        Me.Controls.Add(Me.Label21)
        Me.Controls.Add(Me.Label20)
        Me.Controls.Add(Me.Label19)
        Me.Controls.Add(Me.Label18)
        Me.Controls.Add(Me.Label11)
        Me.Controls.Add(Me.Label10)
        Me.Controls.Add(Me.Label9)
        Me.Controls.Add(Me.Label17)
        Me.Controls.Add(Me.Label16)
        Me.Controls.Add(Me.Label14)
        Me.Controls.Add(Me.Label12)
        Me.Controls.Add(Me.Label15)
        Me.Controls.Add(Me.Label13)
        Me.DoubleBuffered = True
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Icon = CType(resources.GetObject("$this.Icon"), System.Drawing.Icon)
        Me.Name = "AddNewBikes"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "AddNewBikes"
        CType(Me.PictureBox2, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.backbutton, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.numQuantity, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents Label13 As Label
    Friend WithEvents Label15 As Label
    Friend WithEvents Label12 As Label
    Friend WithEvents Label14 As Label
    Friend WithEvents Label16 As Label
    Friend WithEvents Label17 As Label
    Friend WithEvents Label9 As Label
    Friend WithEvents Label10 As Label
    Friend WithEvents Label11 As Label
    Friend WithEvents Label18 As Label
    Friend WithEvents Label19 As Label
    Friend WithEvents Label20 As Label
    Friend WithEvents Label21 As Label
    Friend WithEvents Label22 As Label
    Friend WithEvents PictureBox2 As PictureBox
    Friend WithEvents backbutton As PictureBox
    Friend WithEvents cmbCategory As Guna.UI2.WinForms.Guna2ComboBox
    Friend WithEvents txtBikeName As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtBikeBrand As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents Guna2TextBox3 As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents cmbAvailabilityStatus As Guna.UI2.WinForms.Guna2ComboBox
    Friend WithEvents btnSelectImage As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents txtImageFileName As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtMetaTitle As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtMetaDescription As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtSlug1 As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtHourlyRate As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtDailyRate As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtBikeSize As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents numQuantity As Guna.UI2.WinForms.Guna2NumericUpDown
    Friend WithEvents txtMetaKeywords As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents chkHidden As Guna.UI2.WinForms.Guna2CheckBox
    Friend WithEvents btnSave As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents chkAvailable As Guna.UI2.WinForms.Guna2CheckBox
End Class
