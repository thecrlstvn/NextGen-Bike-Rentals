<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class Login
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Login))
        Me.GetStartedLogo = New System.Windows.Forms.PictureBox()
        Me.btnLogin = New System.Windows.Forms.Button()
        Me.txtEmail = New System.Windows.Forms.TextBox()
        Me.TextBox3 = New System.Windows.Forms.TextBox()
        Me.TextBox4 = New System.Windows.Forms.TextBox()
        Me.txtPassword = New System.Windows.Forms.TextBox()
        Me.TextBox5 = New System.Windows.Forms.TextBox()
        Me.PictureBox1 = New System.Windows.Forms.PictureBox()
        Me.GetStartedBG = New System.Windows.Forms.PictureBox()
        Me.picBoxExit2 = New System.Windows.Forms.PictureBox()
        Me.txtMessage = New System.Windows.Forms.TextBox()
        Me.chkShowPassword = New Guna.UI2.WinForms.Guna2CheckBox()
        CType(Me.GetStartedLogo, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.GetStartedBG, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.picBoxExit2, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'GetStartedLogo
        '
        Me.GetStartedLogo.BackColor = System.Drawing.Color.White
        Me.GetStartedLogo.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None
        Me.GetStartedLogo.Image = CType(resources.GetObject("GetStartedLogo.Image"), System.Drawing.Image)
        Me.GetStartedLogo.Location = New System.Drawing.Point(323, 150)
        Me.GetStartedLogo.Name = "GetStartedLogo"
        Me.GetStartedLogo.Size = New System.Drawing.Size(479, 136)
        Me.GetStartedLogo.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.GetStartedLogo.TabIndex = 2
        Me.GetStartedLogo.TabStop = False
        '
        'btnLogin
        '
        Me.btnLogin.BackColor = System.Drawing.Color.DarkGreen
        Me.btnLogin.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None
        Me.btnLogin.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.btnLogin.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.btnLogin.ForeColor = System.Drawing.Color.White
        Me.btnLogin.Location = New System.Drawing.Point(419, 553)
        Me.btnLogin.Name = "btnLogin"
        Me.btnLogin.Size = New System.Drawing.Size(267, 45)
        Me.btnLogin.TabIndex = 4
        Me.btnLogin.Text = "LOGIN"
        Me.btnLogin.UseVisualStyleBackColor = False
        '
        'txtEmail
        '
        Me.txtEmail.Font = New System.Drawing.Font("Aloevera-Regular", 18.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.txtEmail.Location = New System.Drawing.Point(363, 402)
        Me.txtEmail.Name = "txtEmail"
        Me.txtEmail.Size = New System.Drawing.Size(401, 35)
        Me.txtEmail.TabIndex = 5
        Me.txtEmail.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
        '
        'TextBox3
        '
        Me.TextBox3.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.TextBox3.Font = New System.Drawing.Font("Aloevera-Medium", 12.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.TextBox3.Location = New System.Drawing.Point(363, 377)
        Me.TextBox3.Name = "TextBox3"
        Me.TextBox3.ReadOnly = True
        Me.TextBox3.Size = New System.Drawing.Size(122, 19)
        Me.TextBox3.TabIndex = 7
        Me.TextBox3.Text = "Email Address"
        '
        'TextBox4
        '
        Me.TextBox4.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.TextBox4.Font = New System.Drawing.Font("Aloevera-Medium", 12.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.TextBox4.Location = New System.Drawing.Point(363, 459)
        Me.TextBox4.Name = "TextBox4"
        Me.TextBox4.ReadOnly = True
        Me.TextBox4.Size = New System.Drawing.Size(87, 19)
        Me.TextBox4.TabIndex = 8
        Me.TextBox4.Text = "Password"
        '
        'txtPassword
        '
        Me.txtPassword.Font = New System.Drawing.Font("Aloevera-Regular", 14.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.txtPassword.Location = New System.Drawing.Point(363, 484)
        Me.txtPassword.Name = "txtPassword"
        Me.txtPassword.PasswordChar = Global.Microsoft.VisualBasic.ChrW(42)
        Me.txtPassword.Size = New System.Drawing.Size(401, 29)
        Me.txtPassword.TabIndex = 9
        Me.txtPassword.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
        '
        'TextBox5
        '
        Me.TextBox5.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.TextBox5.Font = New System.Drawing.Font("Aloevera-ExtraBold", 26.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.TextBox5.HideSelection = False
        Me.TextBox5.Location = New System.Drawing.Point(323, 292)
        Me.TextBox5.Name = "TextBox5"
        Me.TextBox5.Size = New System.Drawing.Size(479, 43)
        Me.TextBox5.TabIndex = 10
        Me.TextBox5.Text = "Login as Administrator"
        Me.TextBox5.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
        '
        'PictureBox1
        '
        Me.PictureBox1.Image = CType(resources.GetObject("PictureBox1.Image"), System.Drawing.Image)
        Me.PictureBox1.Location = New System.Drawing.Point(73, 12)
        Me.PictureBox1.Name = "PictureBox1"
        Me.PictureBox1.Size = New System.Drawing.Size(919, 45)
        Me.PictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.PictureBox1.TabIndex = 11
        Me.PictureBox1.TabStop = False
        '
        'GetStartedBG
        '
        Me.GetStartedBG.BackColor = System.Drawing.Color.Transparent
        Me.GetStartedBG.Image = CType(resources.GetObject("GetStartedBG.Image"), System.Drawing.Image)
        Me.GetStartedBG.Location = New System.Drawing.Point(34, 86)
        Me.GetStartedBG.Name = "GetStartedBG"
        Me.GetStartedBG.Size = New System.Drawing.Size(999, 599)
        Me.GetStartedBG.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.GetStartedBG.TabIndex = 12
        Me.GetStartedBG.TabStop = False
        '
        'picBoxExit2
        '
        Me.picBoxExit2.BackColor = System.Drawing.Color.Transparent
        Me.picBoxExit2.Image = CType(resources.GetObject("picBoxExit2.Image"), System.Drawing.Image)
        Me.picBoxExit2.Location = New System.Drawing.Point(1014, 12)
        Me.picBoxExit2.Name = "picBoxExit2"
        Me.picBoxExit2.Size = New System.Drawing.Size(45, 45)
        Me.picBoxExit2.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.picBoxExit2.TabIndex = 13
        Me.picBoxExit2.TabStop = False
        '
        'txtMessage
        '
        Me.txtMessage.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.txtMessage.Font = New System.Drawing.Font("Aloevera-Bold", 15.75!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.txtMessage.Location = New System.Drawing.Point(307, 335)
        Me.txtMessage.Name = "txtMessage"
        Me.txtMessage.Size = New System.Drawing.Size(510, 26)
        Me.txtMessage.TabIndex = 15
        Me.txtMessage.Text = "Authorized Personnel Only"
        Me.txtMessage.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
        '
        'chkShowPassword
        '
        Me.chkShowPassword.AutoSize = True
        Me.chkShowPassword.BackColor = System.Drawing.Color.Transparent
        Me.chkShowPassword.CheckedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkShowPassword.CheckedState.BorderRadius = 0
        Me.chkShowPassword.CheckedState.BorderThickness = 0
        Me.chkShowPassword.CheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(94, Byte), Integer), CType(CType(148, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.chkShowPassword.Location = New System.Drawing.Point(363, 528)
        Me.chkShowPassword.Name = "chkShowPassword"
        Me.chkShowPassword.Size = New System.Drawing.Size(102, 17)
        Me.chkShowPassword.TabIndex = 16
        Me.chkShowPassword.Text = "Show Password"
        Me.chkShowPassword.UncheckedState.BorderColor = System.Drawing.Color.FromArgb(CType(CType(125, Byte), Integer), CType(CType(137, Byte), Integer), CType(CType(149, Byte), Integer))
        Me.chkShowPassword.UncheckedState.BorderRadius = 0
        Me.chkShowPassword.UncheckedState.BorderThickness = 0
        Me.chkShowPassword.UncheckedState.FillColor = System.Drawing.Color.FromArgb(CType(CType(125, Byte), Integer), CType(CType(137, Byte), Integer), CType(CType(149, Byte), Integer))
        Me.chkShowPassword.UseVisualStyleBackColor = False
        '
        'Login
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackColor = System.Drawing.Color.DarkGreen
        Me.ClientSize = New System.Drawing.Size(1080, 720)
        Me.Controls.Add(Me.chkShowPassword)
        Me.Controls.Add(Me.txtMessage)
        Me.Controls.Add(Me.picBoxExit2)
        Me.Controls.Add(Me.PictureBox1)
        Me.Controls.Add(Me.TextBox5)
        Me.Controls.Add(Me.txtPassword)
        Me.Controls.Add(Me.TextBox4)
        Me.Controls.Add(Me.TextBox3)
        Me.Controls.Add(Me.txtEmail)
        Me.Controls.Add(Me.btnLogin)
        Me.Controls.Add(Me.GetStartedLogo)
        Me.Controls.Add(Me.GetStartedBG)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Icon = CType(resources.GetObject("$this.Icon"), System.Drawing.Icon)
        Me.Name = "Login"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "Login"
        CType(Me.GetStartedLogo, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.GetStartedBG, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.picBoxExit2, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents GetStartedLogo As PictureBox
    Friend WithEvents btnLogin As Button
    Friend WithEvents txtEmail As TextBox
    Friend WithEvents TextBox3 As TextBox
    Friend WithEvents TextBox4 As TextBox
    Friend WithEvents txtPassword As TextBox
    Friend WithEvents TextBox5 As TextBox
    Friend WithEvents PictureBox1 As PictureBox
    Friend WithEvents GetStartedBG As PictureBox
    Friend WithEvents picBoxExit2 As PictureBox
    Friend WithEvents txtMessage As TextBox
    Friend WithEvents chkShowPassword As Guna.UI2.WinForms.Guna2CheckBox
End Class
