<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class GetStarted
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(GetStarted))
        Me.GetStartedBG = New System.Windows.Forms.PictureBox()
        Me.GetStartedLogo = New System.Windows.Forms.PictureBox()
        Me.TextBox1 = New System.Windows.Forms.TextBox()
        Me.GetStartedButton = New System.Windows.Forms.Button()
        Me.PictureBox1 = New System.Windows.Forms.PictureBox()
        Me.picBoxExit1 = New System.Windows.Forms.PictureBox()
        CType(Me.GetStartedBG, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.GetStartedLogo, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.picBoxExit1, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'GetStartedBG
        '
        Me.GetStartedBG.BackColor = System.Drawing.Color.Transparent
        Me.GetStartedBG.Image = CType(resources.GetObject("GetStartedBG.Image"), System.Drawing.Image)
        Me.GetStartedBG.Location = New System.Drawing.Point(34, 86)
        Me.GetStartedBG.Name = "GetStartedBG"
        Me.GetStartedBG.Size = New System.Drawing.Size(999, 599)
        Me.GetStartedBG.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.GetStartedBG.TabIndex = 0
        Me.GetStartedBG.TabStop = False
        '
        'GetStartedLogo
        '
        Me.GetStartedLogo.BackColor = System.Drawing.Color.White
        Me.GetStartedLogo.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None
        Me.GetStartedLogo.Image = CType(resources.GetObject("GetStartedLogo.Image"), System.Drawing.Image)
        Me.GetStartedLogo.Location = New System.Drawing.Point(159, 168)
        Me.GetStartedLogo.Name = "GetStartedLogo"
        Me.GetStartedLogo.Size = New System.Drawing.Size(727, 245)
        Me.GetStartedLogo.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.GetStartedLogo.TabIndex = 1
        Me.GetStartedLogo.TabStop = False
        '
        'TextBox1
        '
        Me.TextBox1.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.TextBox1.Enabled = False
        Me.TextBox1.Font = New System.Drawing.Font("Aloevera-Regular", 11.25!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.TextBox1.ForeColor = System.Drawing.Color.Gray
        Me.TextBox1.Location = New System.Drawing.Point(536, 595)
        Me.TextBox1.Name = "TextBox1"
        Me.TextBox1.Size = New System.Drawing.Size(37, 18)
        Me.TextBox1.TabIndex = 2
        Me.TextBox1.Text = "v0.1"
        Me.TextBox1.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
        '
        'GetStartedButton
        '
        Me.GetStartedButton.BackColor = System.Drawing.Color.DarkGreen
        Me.GetStartedButton.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None
        Me.GetStartedButton.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.GetStartedButton.Font = New System.Drawing.Font("Aloevera-Regular", 12.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.GetStartedButton.ForeColor = System.Drawing.Color.White
        Me.GetStartedButton.Location = New System.Drawing.Point(419, 516)
        Me.GetStartedButton.Name = "GetStartedButton"
        Me.GetStartedButton.Size = New System.Drawing.Size(267, 52)
        Me.GetStartedButton.TabIndex = 3
        Me.GetStartedButton.Text = "GET STARTED"
        Me.GetStartedButton.UseVisualStyleBackColor = False
        '
        'PictureBox1
        '
        Me.PictureBox1.Image = CType(resources.GetObject("PictureBox1.Image"), System.Drawing.Image)
        Me.PictureBox1.Location = New System.Drawing.Point(72, 12)
        Me.PictureBox1.Name = "PictureBox1"
        Me.PictureBox1.Size = New System.Drawing.Size(922, 45)
        Me.PictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.PictureBox1.TabIndex = 4
        Me.PictureBox1.TabStop = False
        '
        'picBoxExit1
        '
        Me.picBoxExit1.BackColor = System.Drawing.Color.Transparent
        Me.picBoxExit1.Image = CType(resources.GetObject("picBoxExit1.Image"), System.Drawing.Image)
        Me.picBoxExit1.Location = New System.Drawing.Point(1013, 12)
        Me.picBoxExit1.Name = "picBoxExit1"
        Me.picBoxExit1.Size = New System.Drawing.Size(45, 45)
        Me.picBoxExit1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.picBoxExit1.TabIndex = 5
        Me.picBoxExit1.TabStop = False
        '
        'GetStarted
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.AutoSize = True
        Me.BackColor = System.Drawing.Color.DarkGreen
        Me.ClientSize = New System.Drawing.Size(1080, 720)
        Me.Controls.Add(Me.picBoxExit1)
        Me.Controls.Add(Me.PictureBox1)
        Me.Controls.Add(Me.GetStartedButton)
        Me.Controls.Add(Me.TextBox1)
        Me.Controls.Add(Me.GetStartedLogo)
        Me.Controls.Add(Me.GetStartedBG)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Icon = CType(resources.GetObject("$this.Icon"), System.Drawing.Icon)
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.Name = "GetStarted"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "Get Started with NextGen AOR"
        CType(Me.GetStartedBG, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.GetStartedLogo, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.picBoxExit1, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub

    Friend WithEvents GetStartedBG As PictureBox
    Friend WithEvents GetStartedLogo As PictureBox
    Friend WithEvents TextBox1 As TextBox
    Friend WithEvents GetStartedButton As Button
    Friend WithEvents PictureBox1 As PictureBox
    Friend WithEvents picBoxExit1 As PictureBox
End Class
