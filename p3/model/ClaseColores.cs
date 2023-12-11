using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace p3.model
{
    public class ClaseColores
    {
        // Atributo para representar el color actual
        public Color Actual { get; set; }

        // Atributo para representar el color futuro
        public Color Futuro { get; set; }

        // Constructor que toma los colores actual y futuro como parámetros
        public ClaseColores(Color actual, Color futuro)
        {
            Actual = actual;
            Futuro = futuro;
        }

        // Método para imprimir los colores actuales y futuros
        public string MostrarColores()
        {
            return $"Color actual: {Actual}" + $"Color futuro: {Futuro}";
        }
    }
}
