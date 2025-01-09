<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class ViewCategories
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
        Dim DataGridViewCellStyle1 As System.Windows.Forms.DataGridViewCellStyle = New System.Windows.Forms.DataGridViewCellStyle()
        Dim DataGridViewCellStyle2 As System.Windows.Forms.DataGridViewCellStyle = New System.Windows.Forms.DataGridViewCellStyle()
        Dim DataGridViewCellStyle3 As System.Windows.Forms.DataGridViewCellStyle = New System.Windows.Forms.DataGridViewCellStyle()
        Dim DataGridViewCellStyle4 As System.Windows.Forms.DataGridViewCellStyle = New System.Windows.Forms.DataGridViewCellStyle()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(ViewCategories))
        Me.GunaDataGridView1 = New Guna.UI2.WinForms.Guna2DataGridView()
        Me.btnUpdateCategory = New Guna.UI2.WinForms.Guna2Button()
        Me.txtMetaKeywords = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtMetaDescription = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtMetaTitle = New Guna.UI2.WinForms.Guna2TextBox()
        Me.btnSelectImage1 = New Guna.UI2.WinForms.Guna2Button()
        Me.txtImageFileName1 = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtDescription = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtSlug = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtCategoryName = New Guna.UI2.WinForms.Guna2TextBox()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.Label6 = New System.Windows.Forms.Label()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.Guna2Button1 = New Guna.UI2.WinForms.Guna2Button()
        Me.chkStatus = New Guna.UI2.WinForms.Guna2CheckBox()
        Me.txtCategoryID = New Guna.UI2.WinForms.Guna2TextBox()
        Me.Label8 = New System.Windows.Forms.Label()
        Me.backbutton = New System.Windows.Forms.PictureBox()
        Me.Picture1 = New Guna.UI2.WinForms.Guna2PictureBox()
        Me.Label9 = New System.Windows.Forms.Label()
        Me.AddNewCategories = New Guna.UI2.WinForms.Guna2Button()
        CType(Me.GunaDataGridView1, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.backbutton, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.Picture1, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'GunaDataGridView1
        '
        Me.GunaDataGridView1.AllowUserToOrderColumns = True
        Me.GunaDataGridView1.AllowUserToResizeRows = False
        DataGridViewCellStyle1.BackColor = System.Drawing.Color.White
        DataGridViewCellStyle1.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        DataGridViewCellStyle1.ForeColor = System.Drawing.SystemColors.ControlText
        DataGridViewCellStyle1.SelectionBackColor = System.Drawing.Color.FromArgb(CType(CType(231, Byte), Integer), CType(CType(254, Byte), Integer), CType(CType(240, Byte), Integer))
        DataGridViewCellStyle1.SelectionForeColor = System.Drawing.Color.FromArgb(CType(CType(71, Byte), Integer), CType(CType(69, Byte), Integer), CType(CType(94, Byte), Integer))
        Me.GunaDataGridView1.AlternatingRowsDefaultCellStyle = DataGridViewCellStyle1
        DataGridViewCellStyle2.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft
        DataGridViewCellStyle2.BackColor = System.Drawing.Color.Green
        DataGridViewCellStyle2.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        DataGridViewCellStyle2.ForeColor = System.Drawing.Color.White
        DataGridViewCellStyle2.SelectionBackColor = System.Drawing.Color.Green
        DataGridViewCellStyle2.SelectionForeColor = System.Drawing.SystemColors.HighlightText
        DataGridViewCellStyle2.WrapMode = System.Windows.Forms.DataGridViewTriState.[True]
        Me.GunaDataGridView1.ColumnHeadersDefaultCellStyle = DataGridViewCellStyle2
        Me.GunaDataGridView1.ColumnHeadersHeight = 30
        Me.GunaDataGridView1.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.EnableResizing
        DataGridViewCellStyle3.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft
        DataGridViewCellStyle3.BackColor = System.Drawing.Color.White
        DataGridViewCellStyle3.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        DataGridViewCellStyle3.ForeColor = System.Drawing.Color.FromArgb(CType(CType(71, Byte), Integer), CType(CType(69, Byte), Integer), CType(CType(94, Byte), Integer))
        DataGridViewCellStyle3.SelectionBackColor = System.Drawing.Color.FromArgb(CType(CType(231, Byte), Integer), CType(CType(254, Byte), Integer), CType(CType(240, Byte), Integer))
        DataGridViewCellStyle3.SelectionForeColor = System.Drawing.Color.FromArgb(CType(CType(71, Byte), Integer), CType(CType(69, Byte), Integer), CType(CType(94, Byte), Integer))
        DataGridViewCellStyle3.WrapMode = System.Windows.Forms.DataGridViewTriState.[False]
        Me.GunaDataGridView1.DefaultCellStyle = DataGridViewCellStyle3
        Me.GunaDataGridView1.GridColor = System.Drawing.Color.FromArgb(CType(CType(231, Byte), Integer), CType(CType(229, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.GunaDataGridView1.Location = New System.Drawing.Point(196, 452)
        Me.GunaDataGridView1.Name = "GunaDataGridView1"
        Me.GunaDataGridView1.RowHeadersBorderStyle = System.Windows.Forms.DataGridViewHeaderBorderStyle.None
        DataGridViewCellStyle4.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft
        DataGridViewCellStyle4.BackColor = System.Drawing.Color.White
        DataGridViewCellStyle4.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        DataGridViewCellStyle4.ForeColor = System.Drawing.SystemColors.WindowText
        DataGridViewCellStyle4.SelectionBackColor = System.Drawing.Color.White
        DataGridViewCellStyle4.SelectionForeColor = System.Drawing.SystemColors.HighlightText
        DataGridViewCellStyle4.WrapMode = System.Windows.Forms.DataGridViewTriState.[True]
        Me.GunaDataGridView1.RowHeadersDefaultCellStyle = DataGridViewCellStyle4
        Me.GunaDataGridView1.RowHeadersVisible = False
        Me.GunaDataGridView1.ScrollBars = System.Windows.Forms.ScrollBars.Horizontal
        Me.GunaDataGridView1.Size = New System.Drawing.Size(1051, 242)
        Me.GunaDataGridView1.TabIndex = 68
        Me.GunaDataGridView1.ThemeStyle.AlternatingRowsStyle.BackColor = System.Drawing.Color.White
        Me.GunaDataGridView1.ThemeStyle.AlternatingRowsStyle.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.GunaDataGridView1.ThemeStyle.AlternatingRowsStyle.ForeColor = System.Drawing.SystemColors.ControlText
        Me.GunaDataGridView1.ThemeStyle.AlternatingRowsStyle.SelectionBackColor = System.Drawing.Color.FromArgb(CType(CType(231, Byte), Integer), CType(CType(254, Byte), Integer), CType(CType(240, Byte), Integer))
        Me.GunaDataGridView1.ThemeStyle.AlternatingRowsStyle.SelectionForeColor = System.Drawing.Color.FromArgb(CType(CType(71, Byte), Integer), CType(CType(69, Byte), Integer), CType(CType(94, Byte), Integer))
        Me.GunaDataGridView1.ThemeStyle.BackColor = System.Drawing.Color.White
        Me.GunaDataGridView1.ThemeStyle.GridColor = System.Drawing.Color.FromArgb(CType(CType(231, Byte), Integer), CType(CType(229, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.GunaDataGridView1.ThemeStyle.HeaderStyle.BackColor = System.Drawing.Color.Green
        Me.GunaDataGridView1.ThemeStyle.HeaderStyle.BorderStyle = System.Windows.Forms.DataGridViewHeaderBorderStyle.None
        Me.GunaDataGridView1.ThemeStyle.HeaderStyle.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.GunaDataGridView1.ThemeStyle.HeaderStyle.ForeColor = System.Drawing.Color.White
        Me.GunaDataGridView1.ThemeStyle.HeaderStyle.HeaightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.EnableResizing
        Me.GunaDataGridView1.ThemeStyle.HeaderStyle.Height = 30
        Me.GunaDataGridView1.ThemeStyle.ReadOnly = False
        Me.GunaDataGridView1.ThemeStyle.RowsStyle.BackColor = System.Drawing.Color.White
        Me.GunaDataGridView1.ThemeStyle.RowsStyle.BorderStyle = System.Windows.Forms.DataGridViewCellBorderStyle.SingleHorizontal
        Me.GunaDataGridView1.ThemeStyle.RowsStyle.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.GunaDataGridView1.ThemeStyle.RowsStyle.ForeColor = System.Drawing.Color.FromArgb(CType(CType(71, Byte), Integer), CType(CType(69, Byte), Integer), CType(CType(94, Byte), Integer))
        Me.GunaDataGridView1.ThemeStyle.RowsStyle.Height = 22
        Me.GunaDataGridView1.ThemeStyle.RowsStyle.SelectionBackColor = System.Drawing.Color.FromArgb(CType(CType(231, Byte), Integer), CType(CType(254, Byte), Integer), CType(CType(240, Byte), Integer))
        Me.GunaDataGridView1.ThemeStyle.RowsStyle.SelectionForeColor = System.Drawing.Color.FromArgb(CType(CType(71, Byte), Integer), CType(CType(69, Byte), Integer), CType(CType(94, Byte), Integer))
        '
        'btnUpdateCategory
        '
        Me.btnUpdateCategory.AutoRoundedCorners = True
        Me.btnUpdateCategory.BackColor = System.Drawing.Color.Transparent
        Me.btnUpdateCategory.BorderRadius = 21
        Me.btnUpdateCategory.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.btnUpdateCategory.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.btnUpdateCategory.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.btnUpdateCategory.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.btnUpdateCategory.FillColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(64, Byte), Integer), CType(CType(0, Byte), Integer))
        Me.btnUpdateCategory.Font = New System.Drawing.Font("Aloevera-Regular", 9.749999!, System.Drawing.FontStyle.Bold)
        Me.btnUpdateCategory.ForeColor = System.Drawing.Color.White
        Me.btnUpdateCategory.Location = New System.Drawing.Point(965, 709)
        Me.btnUpdateCategory.Name = "btnUpdateCategory"
        Me.btnUpdateCategory.Size = New System.Drawing.Size(108, 45)
        Me.btnUpdateCategory.TabIndex = 84
        Me.btnUpdateCategory.Text = "Update"
        '
        'txtMetaKeywords
        '
        Me.txtMetaKeywords.BackColor = System.Drawing.Color.Transparent
        Me.txtMetaKeywords.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtMetaKeywords.DefaultText = ""
        Me.txtMetaKeywords.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtMetaKeywords.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtMetaKeywords.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaKeywords.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaKeywords.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaKeywords.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtMetaKeywords.ForeColor = System.Drawing.Color.Transparent
        Me.txtMetaKeywords.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaKeywords.Location = New System.Drawing.Point(556, 365)
        Me.txtMetaKeywords.Name = "txtMetaKeywords"
        Me.txtMetaKeywords.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaKeywords.PlaceholderText = ""
        Me.txtMetaKeywords.SelectedText = ""
        Me.txtMetaKeywords.Size = New System.Drawing.Size(298, 81)
        Me.txtMetaKeywords.TabIndex = 83
        '
        'txtMetaDescription
        '
        Me.txtMetaDescription.AutoRoundedCorners = True
        Me.txtMetaDescription.BackColor = System.Drawing.Color.Transparent
        Me.txtMetaDescription.BorderRadius = 17
        Me.txtMetaDescription.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtMetaDescription.DefaultText = ""
        Me.txtMetaDescription.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtMetaDescription.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtMetaDescription.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaDescription.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaDescription.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaDescription.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtMetaDescription.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaDescription.Location = New System.Drawing.Point(556, 295)
        Me.txtMetaDescription.Name = "txtMetaDescription"
        Me.txtMetaDescription.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaDescription.PlaceholderText = ""
        Me.txtMetaDescription.SelectedText = ""
        Me.txtMetaDescription.Size = New System.Drawing.Size(298, 36)
        Me.txtMetaDescription.TabIndex = 82
        '
        'txtMetaTitle
        '
        Me.txtMetaTitle.AutoRoundedCorners = True
        Me.txtMetaTitle.BackColor = System.Drawing.Color.Transparent
        Me.txtMetaTitle.BorderRadius = 17
        Me.txtMetaTitle.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtMetaTitle.DefaultText = ""
        Me.txtMetaTitle.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtMetaTitle.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtMetaTitle.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaTitle.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtMetaTitle.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaTitle.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtMetaTitle.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtMetaTitle.Location = New System.Drawing.Point(556, 219)
        Me.txtMetaTitle.Name = "txtMetaTitle"
        Me.txtMetaTitle.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaTitle.PlaceholderText = ""
        Me.txtMetaTitle.SelectedText = ""
        Me.txtMetaTitle.Size = New System.Drawing.Size(298, 36)
        Me.txtMetaTitle.TabIndex = 81
        '
        'btnSelectImage1
        '
        Me.btnSelectImage1.AutoRoundedCorners = True
        Me.btnSelectImage1.BackColor = System.Drawing.Color.Transparent
        Me.btnSelectImage1.BorderRadius = 17
        Me.btnSelectImage1.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.btnSelectImage1.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.btnSelectImage1.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.btnSelectImage1.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.btnSelectImage1.FillColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(64, Byte), Integer), CType(CType(0, Byte), Integer))
        Me.btnSelectImage1.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.btnSelectImage1.ForeColor = System.Drawing.Color.White
        Me.btnSelectImage1.Location = New System.Drawing.Point(552, 121)
        Me.btnSelectImage1.Name = "btnSelectImage1"
        Me.btnSelectImage1.Size = New System.Drawing.Size(100, 36)
        Me.btnSelectImage1.TabIndex = 80
        Me.btnSelectImage1.Text = "Choose File"
        '
        'txtImageFileName1
        '
        Me.txtImageFileName1.AutoRoundedCorners = True
        Me.txtImageFileName1.BackColor = System.Drawing.Color.Transparent
        Me.txtImageFileName1.BorderRadius = 17
        Me.txtImageFileName1.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtImageFileName1.DefaultText = ""
        Me.txtImageFileName1.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtImageFileName1.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtImageFileName1.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtImageFileName1.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtImageFileName1.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtImageFileName1.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtImageFileName1.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtImageFileName1.Location = New System.Drawing.Point(658, 121)
        Me.txtImageFileName1.Name = "txtImageFileName1"
        Me.txtImageFileName1.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtImageFileName1.PlaceholderText = ""
        Me.txtImageFileName1.SelectedText = ""
        Me.txtImageFileName1.Size = New System.Drawing.Size(196, 36)
        Me.txtImageFileName1.TabIndex = 79
        '
        'txtDescription
        '
        Me.txtDescription.AutoRoundedCorners = True
        Me.txtDescription.BackColor = System.Drawing.Color.Transparent
        Me.txtDescription.BorderRadius = 17
        Me.txtDescription.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtDescription.DefaultText = ""
        Me.txtDescription.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtDescription.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtDescription.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtDescription.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtDescription.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtDescription.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtDescription.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtDescription.Location = New System.Drawing.Point(196, 327)
        Me.txtDescription.Name = "txtDescription"
        Me.txtDescription.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtDescription.PlaceholderText = ""
        Me.txtDescription.SelectedText = ""
        Me.txtDescription.Size = New System.Drawing.Size(298, 36)
        Me.txtDescription.TabIndex = 78
        '
        'txtSlug
        '
        Me.txtSlug.AutoRoundedCorners = True
        Me.txtSlug.BackColor = System.Drawing.Color.Transparent
        Me.txtSlug.BorderRadius = 17
        Me.txtSlug.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtSlug.DefaultText = ""
        Me.txtSlug.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtSlug.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtSlug.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtSlug.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtSlug.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtSlug.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtSlug.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtSlug.Location = New System.Drawing.Point(196, 258)
        Me.txtSlug.Name = "txtSlug"
        Me.txtSlug.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtSlug.PlaceholderText = ""
        Me.txtSlug.SelectedText = ""
        Me.txtSlug.Size = New System.Drawing.Size(298, 36)
        Me.txtSlug.TabIndex = 77
        '
        'txtCategoryName
        '
        Me.txtCategoryName.AutoRoundedCorners = True
        Me.txtCategoryName.BackColor = System.Drawing.Color.Transparent
        Me.txtCategoryName.BorderRadius = 17
        Me.txtCategoryName.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtCategoryName.DefaultText = ""
        Me.txtCategoryName.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtCategoryName.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtCategoryName.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtCategoryName.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtCategoryName.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtCategoryName.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtCategoryName.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtCategoryName.Location = New System.Drawing.Point(196, 197)
        Me.txtCategoryName.Name = "txtCategoryName"
        Me.txtCategoryName.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtCategoryName.PlaceholderText = ""
        Me.txtCategoryName.SelectedText = ""
        Me.txtCategoryName.Size = New System.Drawing.Size(298, 36)
        Me.txtCategoryName.TabIndex = 76
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.BackColor = System.Drawing.Color.Transparent
        Me.Label7.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label7.Location = New System.Drawing.Point(553, 344)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(130, 18)
        Me.Label7.TabIndex = 75
        Me.Label7.Text = "Meta Keywords"
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.BackColor = System.Drawing.Color.Transparent
        Me.Label6.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label6.Location = New System.Drawing.Point(553, 274)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(139, 18)
        Me.Label6.TabIndex = 74
        Me.Label6.Text = "Meta Description"
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.BackColor = System.Drawing.Color.Transparent
        Me.Label5.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label5.Location = New System.Drawing.Point(553, 198)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(83, 18)
        Me.Label5.TabIndex = 73
        Me.Label5.Text = "Meta Title"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.BackColor = System.Drawing.Color.Transparent
        Me.Label4.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label4.Location = New System.Drawing.Point(553, 100)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(113, 18)
        Me.Label4.TabIndex = 72
        Me.Label4.Text = "Upload Image"
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.BackColor = System.Drawing.Color.Transparent
        Me.Label3.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label3.Location = New System.Drawing.Point(197, 306)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(96, 18)
        Me.Label3.TabIndex = 71
        Me.Label3.Text = "Description"
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.BackColor = System.Drawing.Color.Transparent
        Me.Label2.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label2.Location = New System.Drawing.Point(197, 237)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(39, 18)
        Me.Label2.TabIndex = 70
        Me.Label2.Text = "Slug"
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.BackColor = System.Drawing.Color.Transparent
        Me.Label1.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label1.Location = New System.Drawing.Point(197, 176)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(132, 18)
        Me.Label1.TabIndex = 69
        Me.Label1.Text = "Category Name"
        '
        'Guna2Button1
        '
        Me.Guna2Button1.AutoRoundedCorners = True
        Me.Guna2Button1.BackColor = System.Drawing.Color.Transparent
        Me.Guna2Button1.BorderRadius = 21
        Me.Guna2Button1.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.Guna2Button1.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.Guna2Button1.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.Guna2Button1.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.Guna2Button1.FillColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(64, Byte), Integer), CType(CType(0, Byte), Integer))
        Me.Guna2Button1.Font = New System.Drawing.Font("Aloevera-Regular", 9.749999!, System.Drawing.FontStyle.Bold)
        Me.Guna2Button1.ForeColor = System.Drawing.Color.White
        Me.Guna2Button1.Location = New System.Drawing.Point(1079, 709)
        Me.Guna2Button1.Name = "Guna2Button1"
        Me.Guna2Button1.Size = New System.Drawing.Size(100, 45)
        Me.Guna2Button1.TabIndex = 85
        Me.Guna2Button1.Text = "Delete"
        '
        'chkStatus
        '
        Me.chkStatus.AutoSize = True
        Me.chkStatus.CheckedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkStatus.CheckedState.BorderRadius = 0
        Me.chkStatus.CheckedState.BorderThickness = 0
        Me.chkStatus.CheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkStatus.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!)
        Me.chkStatus.Location = New System.Drawing.Point(200, 406)
        Me.chkStatus.Name = "chkStatus"
        Me.chkStatus.Size = New System.Drawing.Size(69, 17)
        Me.chkStatus.TabIndex = 86
        Me.chkStatus.Text = "STATUS"
        Me.chkStatus.UncheckedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(125, Byte), Integer), CType(CType(137, Byte), Integer), CType(CType(149, Byte), Integer))
        Me.chkStatus.UncheckedState.BorderRadius = 0
        Me.chkStatus.UncheckedState.BorderThickness = 0
        Me.chkStatus.UncheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(125, Byte), Integer), CType(CType(137, Byte), Integer), CType(CType(149, Byte), Integer))
        '
        'txtCategoryID
        '
        Me.txtCategoryID.AutoRoundedCorners = True
        Me.txtCategoryID.BackColor = System.Drawing.Color.Transparent
        Me.txtCategoryID.BorderRadius = 17
        Me.txtCategoryID.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtCategoryID.DefaultText = ""
        Me.txtCategoryID.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtCategoryID.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtCategoryID.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtCategoryID.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtCategoryID.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtCategoryID.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtCategoryID.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtCategoryID.Location = New System.Drawing.Point(196, 128)
        Me.txtCategoryID.Name = "txtCategoryID"
        Me.txtCategoryID.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtCategoryID.PlaceholderText = ""
        Me.txtCategoryID.SelectedText = ""
        Me.txtCategoryID.Size = New System.Drawing.Size(298, 36)
        Me.txtCategoryID.TabIndex = 87
        '
        'Label8
        '
        Me.Label8.AutoSize = True
        Me.Label8.BackColor = System.Drawing.Color.Transparent
        Me.Label8.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label8.Location = New System.Drawing.Point(197, 107)
        Me.Label8.Name = "Label8"
        Me.Label8.Size = New System.Drawing.Size(100, 18)
        Me.Label8.TabIndex = 88
        Me.Label8.Text = "Category ID"
        '
        'backbutton
        '
        Me.backbutton.BackColor = System.Drawing.Color.Transparent
        Me.backbutton.ErrorImage = Nothing
        Me.backbutton.Image = CType(resources.GetObject("backbutton.Image"), System.Drawing.Image)
        Me.backbutton.InitialImage = Nothing
        Me.backbutton.Location = New System.Drawing.Point(1230, 12)
        Me.backbutton.Name = "backbutton"
        Me.backbutton.Size = New System.Drawing.Size(42, 43)
        Me.backbutton.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.backbutton.TabIndex = 89
        Me.backbutton.TabStop = False
        '
        'Picture1
        '
        Me.Picture1.ImageRotate = 0!
        Me.Picture1.Location = New System.Drawing.Point(915, 121)
        Me.Picture1.Name = "Picture1"
        Me.Picture1.Size = New System.Drawing.Size(180, 121)
        Me.Picture1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.Picture1.TabIndex = 90
        Me.Picture1.TabStop = False
        '
        'Label9
        '
        Me.Label9.AutoSize = True
        Me.Label9.BackColor = System.Drawing.Color.Transparent
        Me.Label9.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label9.Location = New System.Drawing.Point(912, 100)
        Me.Label9.Name = "Label9"
        Me.Label9.Size = New System.Drawing.Size(56, 18)
        Me.Label9.TabIndex = 91
        Me.Label9.Text = "Image"
        '
        'AddNewCategories
        '
        Me.AddNewCategories.Animated = True
        Me.AddNewCategories.AutoRoundedCorners = True
        Me.AddNewCategories.BackColor = System.Drawing.Color.Transparent
        Me.AddNewCategories.BorderRadius = 21
        Me.AddNewCategories.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.AddNewCategories.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.AddNewCategories.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.AddNewCategories.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.AddNewCategories.FillColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(64, Byte), Integer), CType(CType(0, Byte), Integer))
        Me.AddNewCategories.Font = New System.Drawing.Font("Aloevera-Regular", 9.749999!, System.Drawing.FontStyle.Bold)
        Me.AddNewCategories.ForeColor = System.Drawing.Color.White
        Me.AddNewCategories.Location = New System.Drawing.Point(773, 709)
        Me.AddNewCategories.Name = "AddNewCategories"
        Me.AddNewCategories.Size = New System.Drawing.Size(186, 45)
        Me.AddNewCategories.TabIndex = 92
        Me.AddNewCategories.Text = "Add New Categories"
        Me.AddNewCategories.UseTransparentBackground = True
        '
        'ViewCategories
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = CType(resources.GetObject("$this.BackgroundImage"), System.Drawing.Image)
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1284, 789)
        Me.Controls.Add(Me.AddNewCategories)
        Me.Controls.Add(Me.Label9)
        Me.Controls.Add(Me.Picture1)
        Me.Controls.Add(Me.backbutton)
        Me.Controls.Add(Me.Label8)
        Me.Controls.Add(Me.txtCategoryID)
        Me.Controls.Add(Me.chkStatus)
        Me.Controls.Add(Me.Guna2Button1)
        Me.Controls.Add(Me.btnUpdateCategory)
        Me.Controls.Add(Me.txtMetaKeywords)
        Me.Controls.Add(Me.txtMetaDescription)
        Me.Controls.Add(Me.txtMetaTitle)
        Me.Controls.Add(Me.btnSelectImage1)
        Me.Controls.Add(Me.txtImageFileName1)
        Me.Controls.Add(Me.txtDescription)
        Me.Controls.Add(Me.txtSlug)
        Me.Controls.Add(Me.txtCategoryName)
        Me.Controls.Add(Me.Label7)
        Me.Controls.Add(Me.Label6)
        Me.Controls.Add(Me.Label5)
        Me.Controls.Add(Me.Label4)
        Me.Controls.Add(Me.Label3)
        Me.Controls.Add(Me.Label2)
        Me.Controls.Add(Me.Label1)
        Me.Controls.Add(Me.GunaDataGridView1)
        Me.DoubleBuffered = True
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Icon = CType(resources.GetObject("$this.Icon"), System.Drawing.Icon)
        Me.Name = "ViewCategories"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "Form1"
        CType(Me.GunaDataGridView1, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.backbutton, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.Picture1, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub

    Friend WithEvents GunaDataGridView1 As Guna.UI2.WinForms.Guna2DataGridView
    Friend WithEvents btnUpdateCategory As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents txtMetaKeywords As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtMetaDescription As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtMetaTitle As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents btnSelectImage1 As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents txtImageFileName1 As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtDescription As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtSlug As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtCategoryName As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents Label7 As Label
    Friend WithEvents Label6 As Label
    Friend WithEvents Label5 As Label
    Friend WithEvents Label4 As Label
    Friend WithEvents Label3 As Label
    Friend WithEvents Label2 As Label
    Friend WithEvents Label1 As Label
    Friend WithEvents Guna2Button1 As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents chkStatus As Guna.UI2.WinForms.Guna2CheckBox
    Friend WithEvents txtCategoryID As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents Label8 As Label
    Friend WithEvents backbutton As PictureBox
    Friend WithEvents Picture1 As Guna.UI2.WinForms.Guna2PictureBox
    Friend WithEvents Label9 As Label
    Friend WithEvents AddNewCategories As Guna.UI2.WinForms.Guna2Button
End Class
