using System;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using Project3.Helpers;

namespace Project3.Model
{
    internal class Kaas : ObservableObject
    {

        private string _naam;
        private int _gewicht;
        private string _type;
        private decimal _prijs;
        private DateTime _productiedatum = DateTime.Today;

        [Key]
        public int Id { get; set; }

        [Required(ErrorMessage = "Dit veld is verplicht.")]
        [StringLength(255)]
        public string Naam
        {
            get => _naam;
            set
            {
                if (_naam != value)
                {
                    _naam = value;
                    OnPropertyChanged(nameof(Naam));
                }
            }
        }

        public int Gewicht
        {
            get => _gewicht;
            set
            {
                if (_gewicht != value)
                {
                    _gewicht = value;
                    OnPropertyChanged(nameof(Gewicht));
                }
            }
        }

        [Required(ErrorMessage = "Dit veld is verplicht.")]
        public string Type
        {
            get => _type;
            set
            {
                if (_type != value)
                {
                    _type = value;
                    OnPropertyChanged(nameof(Type));
                }
            }
        }

        public decimal Prijs
        {
            get => _prijs;
            set
            {
                if (_prijs != value)
                {
                    _prijs = value;
                    OnPropertyChanged(nameof(Prijs));
                }
            }
        }

        public DateTime Productiedatum
        {
            get => _productiedatum;
            set
            {
                if (_productiedatum != value)
                {
                    _productiedatum = value;
                    OnPropertyChanged(nameof(Productiedatum));
                }
            }
        }
    }
}
