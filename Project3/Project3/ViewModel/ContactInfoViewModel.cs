using System.ComponentModel;
using Project3.Helpers;

namespace Project3.ViewModel
{
    internal class ContactInfoViewModel : ObservableObject
    {
        private string _naam;
        private string _telefoon;
        private string _email;

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

        public string Telefoon
        {
            get => _telefoon;
            set
            {
                if (_telefoon != value)
                {
                    _telefoon = value;
                    OnPropertyChanged(nameof(Telefoon));
                }
            }
        }

        public string Email
        {
            get => _email;
            set
            {
                if (_email != value)
                {
                    _email = value;
                    OnPropertyChanged(nameof(Email));
                }
            }
        }

    }
}
