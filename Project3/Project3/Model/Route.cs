using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using Project3.Helpers;

namespace Project3.Model
{
    internal class Route : ObservableObject
    {


        private string _titel;
        private int _kilometer;
        private string _proviand;
        private int _bedragProviand;
        private DateTime _startDatum = DateTime.Today;


        [Key]
        public int Id { get; set; }

        [Required(ErrorMessage = "Dit veld is verplicht.")]
        [StringLength(255)]
        public string Titel
        {
            get => _titel;
            set
            {
                if (_titel != value)
                {
                    _titel = value;
                    OnPropertyChanged(nameof(Titel));
                }
            }
        }
        public int Kilometer
        {
            get => _kilometer;
            set
            {
                if (_kilometer != value)
                {
                    _kilometer = value;
                    OnPropertyChanged(nameof(Kilometer));
                }
            }
        }
        [Required(ErrorMessage = "Dit veld is verplicht.")]
        public string Proviand
        {
            get => _proviand;
            set
            {
                if (_proviand != value)
                {
                    _proviand = value;
                    OnPropertyChanged(nameof(Proviand));
                }
            }
        }

        public int BedragProviand
        {
            get => _bedragProviand;
            set
            {
                if (_bedragProviand != value)
                {
                    _bedragProviand = value;
                    OnPropertyChanged(nameof(BedragProviand));
                }
            }
        }

        public DateTime StartDatum
        {
            get => _startDatum;
            set
            {
                if (_startDatum != value)
                {
                    _startDatum = value;
                    OnPropertyChanged(nameof(StartDatum));
                }
            }
        }

    }
}
