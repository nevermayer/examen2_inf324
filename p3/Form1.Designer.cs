namespace p3;

partial class Form1
{
    /// <summary>
    ///  Required designer variable.
    /// </summary>
    private System.ComponentModel.IContainer components = null;

    /// <summary>
    ///  Clean up any resources being used.
    /// </summary>
    /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
    protected override void Dispose(bool disposing)
    {
        if (disposing && (components != null))
        {
            components.Dispose();
        }
        base.Dispose(disposing);
    }

    #region Windows Form Designer generated code

    /// <summary>
    ///  Required method for Designer support - do not modify
    ///  the contents of this method with the code editor.
    /// </summary>
    private void InitializeComponent()
    {
        pictureBox1 = new PictureBox();
        button1 = new Button();
        groupBox1 = new GroupBox();
        openFileDialog1 = new OpenFileDialog();
        groupBox2 = new GroupBox();
        button2 = new Button();
        button7 = new Button();
        pictureBox3 = new PictureBox();
        pictureBox2 = new PictureBox();
        textBox3 = new TextBox();
        textBox2 = new TextBox();
        textBox1 = new TextBox();
        groupBox3 = new GroupBox();
        listView1 = new ListView();
        button4 = new Button();
        button3 = new Button();
        colorDialog1 = new ColorDialog();
        button5 = new Button();
        ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
        groupBox1.SuspendLayout();
        groupBox2.SuspendLayout();
        ((System.ComponentModel.ISupportInitialize)pictureBox3).BeginInit();
        ((System.ComponentModel.ISupportInitialize)pictureBox2).BeginInit();
        groupBox3.SuspendLayout();
        SuspendLayout();
        // 
        // pictureBox1
        // 
        pictureBox1.BorderStyle = BorderStyle.FixedSingle;
        pictureBox1.Location = new Point(12, 12);
        pictureBox1.Name = "pictureBox1";
        pictureBox1.Size = new Size(758, 487);
        pictureBox1.TabIndex = 0;
        pictureBox1.TabStop = false;
        pictureBox1.MouseClick += pictureBox1_MouseClick;
        // 
        // button1
        // 
        button1.Location = new Point(6, 22);
        button1.Name = "button1";
        button1.Size = new Size(150, 23);
        button1.TabIndex = 1;
        button1.Text = "Abrir Imagen";
        button1.UseVisualStyleBackColor = true;
        button1.Click += button1_Click;
        // 
        // groupBox1
        // 
        groupBox1.Controls.Add(button1);
        groupBox1.Location = new Point(776, 12);
        groupBox1.Name = "groupBox1";
        groupBox1.Size = new Size(162, 62);
        groupBox1.TabIndex = 2;
        groupBox1.TabStop = false;
        groupBox1.Text = "Imagen";
        // 
        // openFileDialog1
        // 
        openFileDialog1.FileName = "openFileDialog1";
        // 
        // groupBox2
        // 
        groupBox2.Controls.Add(button2);
        groupBox2.Controls.Add(button7);
        groupBox2.Controls.Add(pictureBox3);
        groupBox2.Controls.Add(pictureBox2);
        groupBox2.Controls.Add(textBox3);
        groupBox2.Controls.Add(textBox2);
        groupBox2.Controls.Add(textBox1);
        groupBox2.Location = new Point(776, 80);
        groupBox2.Name = "groupBox2";
        groupBox2.Size = new Size(162, 163);
        groupBox2.TabIndex = 3;
        groupBox2.TabStop = false;
        groupBox2.Text = "Color";
        // 
        // button2
        // 
        button2.Location = new Point(8, 107);
        button2.Name = "button2";
        button2.Size = new Size(148, 23);
        button2.TabIndex = 2;
        button2.Text = "Aplicar Cambio";
        button2.UseVisualStyleBackColor = true;
        button2.Click += button2_Click;
        // 
        // button7
        // 
        button7.Location = new Point(8, 134);
        button7.Name = "button7";
        button7.Size = new Size(148, 23);
        button7.TabIndex = 5;
        button7.Text = "Guardar";
        button7.UseVisualStyleBackColor = true;
        button7.Click += button7_Click;
        // 
        // pictureBox3
        // 
        pictureBox3.BorderStyle = BorderStyle.FixedSingle;
        pictureBox3.Location = new Point(75, 66);
        pictureBox3.Name = "pictureBox3";
        pictureBox3.Size = new Size(81, 35);
        pictureBox3.TabIndex = 4;
        pictureBox3.TabStop = false;
        pictureBox3.Click += pictureBox3_Click;
        // 
        // pictureBox2
        // 
        pictureBox2.BorderStyle = BorderStyle.FixedSingle;
        pictureBox2.Location = new Point(75, 22);
        pictureBox2.Name = "pictureBox2";
        pictureBox2.Size = new Size(81, 35);
        pictureBox2.TabIndex = 3;
        pictureBox2.TabStop = false;
        // 
        // textBox3
        // 
        textBox3.Location = new Point(8, 78);
        textBox3.Name = "textBox3";
        textBox3.Size = new Size(57, 23);
        textBox3.TabIndex = 2;
        // 
        // textBox2
        // 
        textBox2.Location = new Point(8, 49);
        textBox2.Name = "textBox2";
        textBox2.Size = new Size(57, 23);
        textBox2.TabIndex = 1;
        // 
        // textBox1
        // 
        textBox1.Location = new Point(8, 22);
        textBox1.Name = "textBox1";
        textBox1.Size = new Size(57, 23);
        textBox1.TabIndex = 0;
        // 
        // groupBox3
        // 
        groupBox3.Controls.Add(button5);
        groupBox3.Controls.Add(listView1);
        groupBox3.Controls.Add(button4);
        groupBox3.Controls.Add(button3);
        groupBox3.Location = new Point(776, 249);
        groupBox3.Name = "groupBox3";
        groupBox3.Size = new Size(162, 223);
        groupBox3.TabIndex = 4;
        groupBox3.TabStop = false;
        groupBox3.Text = "Cambio de Colores";
        // 
        // listView1
        // 
        listView1.Location = new Point(8, 51);
        listView1.Name = "listView1";
        listView1.Size = new Size(148, 103);
        listView1.TabIndex = 2;
        listView1.UseCompatibleStateImageBehavior = false;
        // 
        // button4
        // 
        button4.Location = new Point(8, 160);
        button4.Name = "button4";
        button4.Size = new Size(148, 23);
        button4.TabIndex = 1;
        button4.Text = "Aplicar todos";
        button4.UseVisualStyleBackColor = true;
        button4.Click += button4_Click;
        // 
        // button3
        // 
        button3.Location = new Point(8, 22);
        button3.Name = "button3";
        button3.Size = new Size(148, 23);
        button3.TabIndex = 0;
        button3.Text = "Cargar Colores";
        button3.UseVisualStyleBackColor = true;
        button3.Click += button3_Click;
        // 
        // button5
        // 
        button5.Location = new Point(8, 187);
        button5.Name = "button5";
        button5.Size = new Size(148, 23);
        button5.TabIndex = 3;
        button5.Text = "Limpiar";
        button5.UseVisualStyleBackColor = true;
        button5.Click += button5_Click;
        // 
        // Form1
        // 
        AutoScaleDimensions = new SizeF(7F, 15F);
        AutoScaleMode = AutoScaleMode.Font;
        ClientSize = new Size(944, 511);
        Controls.Add(groupBox3);
        Controls.Add(groupBox2);
        Controls.Add(groupBox1);
        Controls.Add(pictureBox1);
        MaximizeBox = false;
        Name = "Form1";
        Text = "Form1";
        ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
        groupBox1.ResumeLayout(false);
        groupBox2.ResumeLayout(false);
        groupBox2.PerformLayout();
        ((System.ComponentModel.ISupportInitialize)pictureBox3).EndInit();
        ((System.ComponentModel.ISupportInitialize)pictureBox2).EndInit();
        groupBox3.ResumeLayout(false);
        ResumeLayout(false);
    }

    #endregion

    private PictureBox pictureBox1;
    private Button button1;
    private GroupBox groupBox1;
    private OpenFileDialog openFileDialog1;
    private GroupBox groupBox2;
    private PictureBox pictureBox2;
    private TextBox textBox3;
    private TextBox textBox2;
    private TextBox textBox1;
    private GroupBox groupBox3;
    private Button button3;
    private Button button4;
    private ColorDialog colorDialog1;
    private Button button7;
    private PictureBox pictureBox3;
    private Button button2;
    private ListView listView1;
    private Button button5;
}
