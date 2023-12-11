using MySqlConnector;
using p3.model;
using System.Drawing;


namespace p3;

public partial class Form1 : Form
{
    Color actual;
    Color futuro;
    int Rm, Gm, Bm;
    int Rmc, Gmc, Bmc, L = 10;
    List<ClaseColores> listaColores;
    public Form1()
    {
        InitializeComponent();
        // Inicializa la lista de colores
        listaColores = ObtenerColoresDesdeBaseDeDatos();

        // Configura el ListView
        listView1.View = View.Details;
        listView1.Columns.Add("Color 1", 70);
        listView1.Columns.Add("Color 2", 70);

        // Llena el ListView con datos
        LlenarListView();
        // Asocia el evento ItemSelectionChanged al manejador de eventos correspondiente
        listView1.ItemSelectionChanged += ListView1_ItemSelectionChanged;
    }
    private void ListView1_ItemSelectionChanged(object sender, ListViewItemSelectionChangedEventArgs e)
    {
        // Verifica si algún elemento está seleccionado
        if (e.IsSelected)
        {
            int posicion = e.ItemIndex;
            pictureBox2.BackColor = listaColores[posicion].Actual;
            pictureBox3.BackColor = listaColores[posicion].Futuro;
            colorDialog1.Color = listaColores[posicion].Futuro;
            actual = listaColores[posicion].Actual;
            futuro = listaColores[posicion].Futuro;
        }
    }
    private void LlenarListView()
    {
        listView1.Items.Clear();
        foreach (var color in listaColores)
        {
            ListViewItem item = new ListViewItem(color.Actual.R + " " + color.Actual.G + " " + color.Actual.B);
            item.SubItems.Add(color.Futuro.R + " " + color.Futuro.G + " " + color.Futuro.B);
            listView1.Items.Add(item);
        }
    }

    private void button1_Click(object sender, EventArgs e)
    {
        openFileDialog1.FileName = string.Empty;
        openFileDialog1.Filter = "Archivos JPG|*.JPG|Archivos BMP|*.bmp|Archivos PNG|*.png";
        openFileDialog1.ShowDialog();
        if (openFileDialog1.FileName != string.Empty)
        {
            Bitmap bmp = new Bitmap(openFileDialog1.FileName);
            pictureBox1.Image = bmp;
        }
    }

    private void button2_Click(object sender, EventArgs e)
    {
        actual = Color.FromArgb(Rm, Gm, Bm);
        futuro = colorDialog1.Color;
        cambiarColor(actual, futuro);
    }

    private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
    {
        Bitmap bmp = new Bitmap(pictureBox1.Image);
        Color c = new Color();
        c = bmp.GetPixel(e.X, e.Y);
        Rm = c.R;
        Gm = c.G;
        Bm = c.B;
        Rmc = 0; Gmc = 0; Bmc = 0;
        textBox1.Text = c.R.ToString();
        textBox2.Text = c.G.ToString();
        textBox3.Text = c.B.ToString();
        for (int i = e.X - ((int)L / 2); i < e.X + ((int)L / 2); i++)
            for (int j = e.Y - ((int)L / 2); j < e.Y + ((int)L / 2); j++)
            {
                c = bmp.GetPixel(i, j);
                Rmc = Rmc + c.R; Gmc = Gmc + c.G; Bmc = Bmc + c.B;
            }
        Rmc = (int)Rmc / (L * L);
        Gmc = (int)Gmc / (L * L);
        Bmc = (int)Bmc / (L * L);
        textBox1.Text = textBox1.Text + " " + Rmc.ToString();
        textBox2.Text = textBox2.Text + " " + Gmc.ToString();
        textBox3.Text = textBox3.Text + " " + Bmc.ToString();
        pictureBox2.BackColor = Color.FromArgb(c.R, c.G, c.B);
    }

    private void button3_Click(object sender, EventArgs e)
    {
        listaColores = ObtenerColoresDesdeBaseDeDatos();
        LlenarListView();
    }

    private List<ClaseColores> ObtenerColoresDesdeBaseDeDatos()
    {
        List<ClaseColores> colores = new List<ClaseColores>();
        string connectionString = "Server=localhost;Database=midb_ramos;Uid=root;Pwd=;";
        MySqlConnection connection = new MySqlConnection(connectionString);
        try
        {
            connection.Open();
            Console.WriteLine("Conexión exitosa a MySQL.");
            string consultaSQL = "SELECT ColorActualR, ColorActualG, ColorActualB, ColorFuturoR, ColorFuturoG, ColorFuturoB FROM colores ";
            MySqlCommand cmd = new MySqlCommand(consultaSQL, connection);
            using (MySqlDataReader reader = cmd.ExecuteReader())
            {
                while (reader.Read())
                {
                    int actualR = Convert.ToInt32(reader["ColorActualR"]);
                    int actualG = Convert.ToInt32(reader["ColorActualG"]);
                    int actualB = Convert.ToInt32(reader["ColorActualB"]);

                    int futuroR = Convert.ToInt32(reader["ColorFuturoR"]);
                    int futuroG = Convert.ToInt32(reader["ColorFuturoG"]);
                    int futuroB = Convert.ToInt32(reader["ColorFuturoB"]);

                    Color colorActual = Color.FromArgb(actualR, actualG, actualB);
                    Color colorFuturo = Color.FromArgb(futuroR, futuroG, futuroB);

                    ClaseColores color = new ClaseColores(colorActual, colorFuturo);
                    colores.Add(color);
                }
            }
            connection.Close();
        }
        catch (MySqlException ex)
        {
            MessageBox.Show("Error al conectar a MySQL: " + ex.Message);
        }
        return colores;
    }

    private void button4_Click(object sender, EventArgs e)
    {
        foreach (var color in listaColores)
        {
            cambiarColor(color.Actual, color.Futuro);
        }
    }


    private void pictureBox3_Click(object sender, EventArgs e)
    {
        colorDialog1.ShowDialog();
        pictureBox3.BackColor = colorDialog1.Color;

    }

    private void button7_Click(object sender, EventArgs e)
    {
        // Aquí puedes implementar la lógica para obtener el nuevo color y guardarlo en la base de datos
        Color nuevoColorActual = pictureBox2.BackColor;
        Color nuevoColorFuturo = pictureBox3.BackColor;
        GuardarColorEnBaseDeDatos(nuevoColorActual, nuevoColorFuturo);

        // Actualiza la lista de colores y el ListView
        listaColores = ObtenerColoresDesdeBaseDeDatos();
        LlenarListView();
    }

    private void GuardarColorEnBaseDeDatos(Color actual, Color futuro)
    {
        string connectionString = "Server=localhost;Database=midb_ramos;Uid=root;Pwd=;";

        try
        {
            using (MySqlConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                Console.WriteLine("Conexión exitosa a MySQL.");
                // Reemplaza "TuTabla" con el nombre real de tu tabla
                string consultaSQL = "INSERT INTO colores (ColorActualR, ColorActualG, ColorActualB, ColorFuturoR, ColorFuturoG, ColorFuturoB) " +
                               "VALUES (@ActualR, @ActualG, @ActualB, @FuturoR, @FuturoG, @FuturoB)";

                using (MySqlCommand command = new MySqlCommand(consultaSQL, connection))
                {
                    command.Parameters.AddWithValue("@ActualR", actual.R);
                    command.Parameters.AddWithValue("@ActualG", actual.G);
                    command.Parameters.AddWithValue("@ActualB", actual.B);

                    command.Parameters.AddWithValue("@FuturoR", futuro.R);
                    command.Parameters.AddWithValue("@FuturoG", futuro.G);
                    command.Parameters.AddWithValue("@FuturoB", futuro.B);

                    command.ExecuteNonQuery();
                }
            }
        }
        catch (MySqlException ex)
        {
            MessageBox.Show("Error al conectar a MySQL: " + ex.Message);
        }

    }

    private void cambiarColor(Color actual, Color futuro)
    {
        Bitmap bmp = new Bitmap(pictureBox1.Image);
        Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
        int Rt, Gt, Bt;
        Color c = new Color();
        for (int i = 0; i < bmp.Width - L; i = i + L)
            for (int j = 0; j < bmp.Height - L; j = j + L)
            {
                Rt = 0; Gt = 0; Bt = 0;
                for (int o = i; o < i + L; o++)
                    for (int p = j; p < j + L; p++)
                    {
                        c = bmp.GetPixel(o, p);
                        Rt = Rt + c.R;
                        Gt = Gt + c.G;
                        Bt = Bt + c.B;
                    }
                Rt = Rt / (L * L); Gt = Gt / (L * L); Bt = Bt / (L * L);
                if (((actual.R - 10 < Rt) && (Rt < actual.R + 10))
                    && ((actual.G - 10 < Gt) && (Gt < actual.G + 10))
                    && ((actual.B - 10 < Bt) && (Bt < actual.B + 10)))
                {
                    for (int o = i; o < i + L; o++)
                        for (int p = j; p < j + L; p++)
                        {
                            bmp2.SetPixel(o, p, futuro);
                        }
                }
                else
                {
                    for (int o = i; o < i + L; o++)
                        for (int p = j; p < j + L; p++)
                        {
                            c = bmp.GetPixel(o, p);
                            bmp2.SetPixel(o, p, Color.FromArgb(c.R, c.G, c.B));
                        }
                }
            }
        pictureBox1.Image = bmp2;
    }

    private void button5_Click(object sender, EventArgs e)
    {
  
            string connectionString = "Server=localhost;Database=midb_ramos;Uid=root;Pwd=;";

        try
        {
            using (MySqlConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                Console.WriteLine("Conexión exitosa a MySQL.");
                
                string consultaSQL = "TRUNCATE TABLE colores";

                using (MySqlCommand command = new MySqlCommand(consultaSQL, connection))
                {
                    command.ExecuteNonQuery();
                }
            }
        }
        catch (MySqlException ex)
        {
            MessageBox.Show("Error al conectar a MySQL: " + ex.Message);
        }
    }
}
