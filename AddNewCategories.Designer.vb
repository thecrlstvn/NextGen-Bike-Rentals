<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class AddNewCategories
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(AddNewCategories))
        Me.PictureBox1 = New System.Windows.Forms.PictureBox()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.Label6 = New System.Windows.Forms.Label()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.Label9 = New System.Windows.Forms.Label()
        Me.backbutton2 = New System.Windows.Forms.PictureBox()
        Me.txtCategoryName = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtSlug2 = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtDescription = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtImageFileName1 = New Guna.UI2.WinForms.Guna2TextBox()
        Me.btnSelectImage1 = New Guna.UI2.WinForms.Guna2Button()
        Me.txtMetaTitle = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtMetaDescription = New Guna.UI2.WinForms.Guna2TextBox()
        Me.txtMetaKeywords = New Guna.UI2.WinForms.Guna2TextBox()
        Me.btncategory = New Guna.UI2.WinForms.Guna2Button()
        Me.Guna2CheckBox2 = New Guna.UI2.WinForms.Guna2CheckBox()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.backbutton2, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'PictureBox1
        '
        Me.PictureBox1.Image = CType(resources.GetObject("PictureBox1.Image"), System.Drawing.Image)
        Me.PictureBox1.Location = New System.Drawing.Point(43, 205)
        Me.PictureBox1.Name = "PictureBox1"
        Me.PictureBox1.Size = New System.Drawing.Size(129, 59)
        Me.PictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.PictureBox1.TabIndex = 0
        Me.PictureBox1.TabStop = False
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.BackColor = System.Drawing.Color.Transparent
        Me.Label1.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label1.Location = New System.Drawing.Point(307, 104)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(132, 18)
        Me.Label1.TabIndex = 1
        Me.Label1.Text = "Category Name"
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.BackColor = System.Drawing.Color.Transparent
        Me.Label2.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label2.Location = New System.Drawing.Point(307, 175)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(39, 18)
        Me.Label2.TabIndex = 6
        Me.Label2.Text = "Slug"
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.BackColor = System.Drawing.Color.Transparent
        Me.Label3.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label3.Location = New System.Drawing.Point(307, 246)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(96, 18)
        Me.Label3.TabIndex = 7
        Me.Label3.Text = "Description"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.BackColor = System.Drawing.Color.Transparent
        Me.Label4.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label4.Location = New System.Drawing.Point(307, 324)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(113, 18)
        Me.Label4.TabIndex = 9
        Me.Label4.Text = "Upload Image"
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.BackColor = System.Drawing.Color.Transparent
        Me.Label5.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label5.Location = New System.Drawing.Point(307, 398)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(83, 18)
        Me.Label5.TabIndex = 12
        Me.Label5.Text = "Meta Title"
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.BackColor = System.Drawing.Color.Transparent
        Me.Label6.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label6.Location = New System.Drawing.Point(300, 476)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(139, 18)
        Me.Label6.TabIndex = 14
        Me.Label6.Text = "Meta Description"
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.BackColor = System.Drawing.Color.Transparent
        Me.Label7.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label7.Location = New System.Drawing.Point(300, 548)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(130, 18)
        Me.Label7.TabIndex = 16
        Me.Label7.Text = "Meta Keywords"
        '
        'Label9
        '
        Me.Label9.AutoSize = True
        Me.Label9.BackColor = System.Drawing.Color.Transparent
        Me.Label9.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label9.Location = New System.Drawing.Point(307, 733)
        Me.Label9.Name = "Label9"
        Me.Label9.Size = New System.Drawing.Size(71, 18)
        Me.Label9.TabIndex = 20
        Me.Label9.Text = "Inactive"
        '
        'backbutton2
        '
        Me.backbutton2.BackColor = System.Drawing.Color.Transparent
        Me.backbutton2.Image = CType(resources.GetObject("backbutton2.Image"), System.Drawing.Image)
        Me.backbutton2.InitialImage = Nothing
        Me.backbutton2.Location = New System.Drawing.Point(1244, 12)
        Me.backbutton2.Name = "backbutton2"
        Me.backbutton2.Size = New System.Drawing.Size(44, 43)
        Me.backbutton2.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.backbutton2.TabIndex = 47
        Me.backbutton2.TabStop = False
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
        Me.txtCategoryName.Location = New System.Drawing.Point(303, 125)
        Me.txtCategoryName.Name = "txtCategoryName"
        Me.txtCategoryName.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtCategoryName.PlaceholderText = ""
        Me.txtCategoryName.SelectedText = ""
        Me.txtCategoryName.Size = New System.Drawing.Size(298, 36)
        Me.txtCategoryName.TabIndex = 49
        '
        'txtSlug2
        '
        Me.txtSlug2.AutoRoundedCorners = True
        Me.txtSlug2.BackColor = System.Drawing.Color.Transparent
        Me.txtSlug2.BorderRadius = 17
        Me.txtSlug2.Cursor = System.Windows.Forms.Cursors.IBeam
        Me.txtSlug2.DefaultText = ""
        Me.txtSlug2.DisabledState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer), CType(CType(208, Byte), Integer))
        Me.txtSlug2.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer), CType(CType(226, Byte), Integer))
        Me.txtSlug2.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtSlug2.DisabledState.PlaceholderForeColor = System.Drawing.Color.FromArgb(CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer), CType(CType(138, Byte), Integer))
        Me.txtSlug2.FocusedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtSlug2.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.txtSlug2.HoverState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.txtSlug2.Location = New System.Drawing.Point(303, 196)
        Me.txtSlug2.Name = "txtSlug2"
        Me.txtSlug2.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtSlug2.PlaceholderText = ""
        Me.txtSlug2.SelectedText = ""
        Me.txtSlug2.Size = New System.Drawing.Size(298, 36)
        Me.txtSlug2.TabIndex = 50
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
        Me.txtDescription.Location = New System.Drawing.Point(303, 277)
        Me.txtDescription.Name = "txtDescription"
        Me.txtDescription.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtDescription.PlaceholderText = ""
        Me.txtDescription.SelectedText = ""
        Me.txtDescription.Size = New System.Drawing.Size(298, 36)
        Me.txtDescription.TabIndex = 51
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
        Me.txtImageFileName1.Location = New System.Drawing.Point(405, 349)
        Me.txtImageFileName1.Name = "txtImageFileName1"
        Me.txtImageFileName1.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtImageFileName1.PlaceholderText = ""
        Me.txtImageFileName1.SelectedText = ""
        Me.txtImageFileName1.Size = New System.Drawing.Size(196, 36)
        Me.txtImageFileName1.TabIndex = 52
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
        Me.btnSelectImage1.Location = New System.Drawing.Point(303, 349)
        Me.btnSelectImage1.Name = "btnSelectImage1"
        Me.btnSelectImage1.Size = New System.Drawing.Size(100, 36)
        Me.btnSelectImage1.TabIndex = 53
        Me.btnSelectImage1.Text = "Choose File"
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
        Me.txtMetaTitle.Location = New System.Drawing.Point(303, 428)
        Me.txtMetaTitle.Name = "txtMetaTitle"
        Me.txtMetaTitle.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaTitle.PlaceholderText = ""
        Me.txtMetaTitle.SelectedText = ""
        Me.txtMetaTitle.Size = New System.Drawing.Size(298, 36)
        Me.txtMetaTitle.TabIndex = 54
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
        Me.txtMetaDescription.Location = New System.Drawing.Point(303, 497)
        Me.txtMetaDescription.Name = "txtMetaDescription"
        Me.txtMetaDescription.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaDescription.PlaceholderText = ""
        Me.txtMetaDescription.SelectedText = ""
        Me.txtMetaDescription.Size = New System.Drawing.Size(298, 36)
        Me.txtMetaDescription.TabIndex = 55
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
        Me.txtMetaKeywords.Location = New System.Drawing.Point(303, 569)
        Me.txtMetaKeywords.Name = "txtMetaKeywords"
        Me.txtMetaKeywords.PasswordChar = Global.Microsoft.VisualBasic.ChrW(0)
        Me.txtMetaKeywords.PlaceholderText = ""
        Me.txtMetaKeywords.SelectedText = ""
        Me.txtMetaKeywords.Size = New System.Drawing.Size(298, 81)
        Me.txtMetaKeywords.TabIndex = 56
        '
        'btncategory
        '
        Me.btncategory.AutoRoundedCorners = True
        Me.btncategory.BackColor = System.Drawing.Color.Transparent
        Me.btncategory.BorderRadius = 17
        Me.btncategory.DisabledState.BorderColor = System.Drawing.Color.DarkGray
        Me.btncategory.DisabledState.CustomBorderColor = System.Drawing.Color.DarkGray
        Me.btncategory.DisabledState.FillColor = System.Drawing.Color.FromArgb(CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer), CType(CType(169, Byte), Integer))
        Me.btncategory.DisabledState.ForeColor = System.Drawing.Color.FromArgb(CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer), CType(CType(141, Byte), Integer))
        Me.btncategory.FillColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(64, Byte), Integer), CType(CType(0, Byte), Integer))
        Me.btncategory.Font = New System.Drawing.Font("Segoe UI", 9.0!)
        Me.btncategory.ForeColor = System.Drawing.Color.White
        Me.btncategory.Location = New System.Drawing.Point(303, 656)
        Me.btncategory.Name = "btncategory"
        Me.btncategory.Size = New System.Drawing.Size(100, 36)
        Me.btncategory.TabIndex = 57
        Me.btncategory.Text = "Add Category"
        '
        'Guna2CheckBox2
        '
        Me.Guna2CheckBox2.AutoSize = True
        Me.Guna2CheckBox2.BackColor = System.Drawing.Color.Transparent
        Me.Guna2CheckBox2.CheckedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.Guna2CheckBox2.CheckedState.BorderRadius = 0
        Me.Guna2CheckBox2.CheckedState.BorderThickness = 0
        Me.Guna2CheckBox2.CheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.Guna2CheckBox2.CheckMarkColor = System.Drawing.Color.Transparent
        Me.Guna2CheckBox2.Font = New System.Drawing.Font("Microsoft Sans Serif", 8.25!)
        Me.Guna2CheckBox2.Location = New System.Drawing.Point(533, 733)
        Me.Guna2CheckBox2.Name = "Guna2CheckBox2"
        Me.Guna2CheckBox2.Size = New System.Drawing.Size(56, 17)
        Me.Guna2CheckBox2.TabIndex = 65
        Me.Guna2CheckBox2.Text = "Active"
        Me.Guna2CheckBox2.UncheckedState.BorderColor = System.Drawing.Color.Transparent
        Me.Guna2CheckBox2.UncheckedState.BorderRadius = 0
        Me.Guna2CheckBox2.UncheckedState.BorderThickness = 0
        Me.Guna2CheckBox2.UncheckedState.FillColor = System.Drawing.Color.White
        Me.Guna2CheckBox2.UseVisualStyleBackColor = False
        '
        'AddNewCategories
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = CType(resources.GetObject("$this.BackgroundImage"), System.Drawing.Image)
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1300, 828)
        Me.Controls.Add(Me.Guna2CheckBox2)
        Me.Controls.Add(Me.btncategory)
        Me.Controls.Add(Me.txtMetaKeywords)
        Me.Controls.Add(Me.txtMetaDescription)
        Me.Controls.Add(Me.txtMetaTitle)
        Me.Controls.Add(Me.btnSelectImage1)
        Me.Controls.Add(Me.txtImageFileName1)
        Me.Controls.Add(Me.txtDescription)
        Me.Controls.Add(Me.txtSlug2)
        Me.Controls.Add(Me.txtCategoryName)
        Me.Controls.Add(Me.backbutton2)
        Me.Controls.Add(Me.Label9)
        Me.Controls.Add(Me.Label7)
        Me.Controls.Add(Me.Label6)
        Me.Controls.Add(Me.Label5)
        Me.Controls.Add(Me.Label4)
        Me.Controls.Add(Me.Label3)
        Me.Controls.Add(Me.Label2)
        Me.Controls.Add(Me.Label1)
        Me.Controls.Add(Me.PictureBox1)
        Me.DoubleBuffered = True
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Icon = CType(resources.GetObject("$this.Icon"), System.Drawing.Icon)
        Me.Name = "AddNewCategories"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "AddNewCategories"
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.backbutton2, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub

    Friend WithEvents PictureBox1 As PictureBox
    Friend WithEvents Label1 As Label
    Friend WithEvents Label2 As Label
    Friend WithEvents Label3 As Label
    Friend WithEvents Label4 As Label
    Friend WithEvents Label5 As Label
    Friend WithEvents Label6 As Label
    Friend WithEvents Label7 As Label
    Friend WithEvents Label9 As Label
    Friend WithEvents backbutton2 As PictureBox
    Friend WithEvents txtCategoryName As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtSlug2 As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtDescription As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtImageFileName1 As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents btnSelectImage1 As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents txtMetaTitle As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtMetaDescription As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents txtMetaKeywords As Guna.UI2.WinForms.Guna2TextBox
    Friend WithEvents btncategory As Guna.UI2.WinForms.Guna2Button
    Friend WithEvents Guna2CheckBox2 As Guna.UI2.WinForms.Guna2CheckBox
End Class
