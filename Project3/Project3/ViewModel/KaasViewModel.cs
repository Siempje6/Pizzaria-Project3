using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;
using Project3.Databases;
using Project3.Helpers;
using Project3.Model;
using Project3.View;

namespace Project3.ViewModel
{
    internal class KaasViewModel : ObservableObject
    {
        private Kaas? _selectedKaas;
        private Kaas _kaas = new();

        public ObservableCollection<Kaas> Kazen { get; } = new();

        public Kaas? SelectedKaas
        {
            get => _selectedKaas;
            set
            {
                if (_selectedKaas != value)
                {
                    _selectedKaas = value;
                    OnPropertyChanged();
                }
            }
        }

        public Kaas Kaas
        {
            get => _kaas;
            set
            {
                if (_kaas != value)
                {
                    _kaas = value;
                    OnPropertyChanged();
                }
            }
        }

        public RelayCommand AddKaasCommand { get; }
        public RelayCommand UpdateKaasCommand { get; }
        public RelayCommand DeleteKaasCommand { get; }

        private readonly UserMessage _userMessage;

#pragma warning disable CS8618 // Non-nullable field must contain a non-null value when exiting constructor. Consider adding the 'required' modifier or declaring as nullable.
        public KaasViewModel()
#pragma warning restore CS8618 // Non-nullable field must contain a non-null value when exiting constructor. Consider adding the 'required' modifier or declaring as nullable.
        {

        }
        public KaasViewModel(UserMessage userMessage)
        {
            using (F1DbContext db = new())
            {
                Kazen = new(db.Kazen.ToList());
            }
            AddKaasCommand = new RelayCommand(AddKaas);
            UpdateKaasCommand = new RelayCommand(UpdateKaas, CanUpdateKaas);
            DeleteKaasCommand = new RelayCommand(DeleteKaas, CanDeleteKaas);
            _userMessage = userMessage;
        }

        private void AddKaas(object? parameter)
        {
            try
            {
                Kazen.Add(Kaas);

                using F1DbContext dbContext = new();
                Kaas.Id = 0;
                dbContext.Kazen.Add(Kaas);
                dbContext.SaveChanges();

                Kaas = new Kaas();
            }
            catch (Exception ex)
            {
                _userMessage.Text = ex.InnerException == null ? ex.Message : ex.InnerException.Message;
            }
        }

        private void UpdateKaas(object? parameter)
        {
            try
            {
                if (SelectedKaas != null)
                {
                    SelectedKaas.Naam = Kaas.Naam;
                    SelectedKaas.Gewicht = Kaas.Gewicht;
                    SelectedKaas.Type = Kaas.Type;
                    SelectedKaas.Prijs = Kaas.Prijs;
                    SelectedKaas.Productiedatum = Kaas.Productiedatum;

                    using F1DbContext dbContext = new();
                    Kaas? databaseKaas = dbContext.Kazen.FirstOrDefault(x => x.Id == SelectedKaas.Id);
                    if (databaseKaas != null)
                    {
                        databaseKaas.Naam = SelectedKaas.Naam;
                        databaseKaas.Gewicht = SelectedKaas.Gewicht;
                        databaseKaas.Type = SelectedKaas.Type;
                        databaseKaas.Prijs = SelectedKaas.Prijs;
                        databaseKaas.Productiedatum = SelectedKaas.Productiedatum;
                        dbContext.SaveChanges();
                    }

                    Kaas = new Kaas();
                }
            }
            catch (Exception ex)
            {
                _userMessage.Text = ex.InnerException == null ? ex.Message : ex.InnerException.Message;
            }
        }

        private void DeleteKaas(object? parameter)
        {
            try
            {
                if (parameter is Kaas kaasToDelete)
                {
                    Kazen.Remove(kaasToDelete);

                    using F1DbContext dbContext = new();
                    Kaas? databaseKaas = dbContext.Kazen.FirstOrDefault(x => x.Id == kaasToDelete.Id);
                    if (databaseKaas != null)
                    {
                        dbContext.Kazen.Remove(databaseKaas);
                        dbContext.SaveChanges();
                    }
                }
            }
            catch (Exception ex)
            {
                _userMessage.Text = ex.InnerException == null ? ex.Message : ex.InnerException.Message;
            }
        }

        private bool CanUpdateKaas(object? parameter)
        {
            return SelectedKaas != null && !string.IsNullOrWhiteSpace(Kaas.Naam);
        }

        private bool CanDeleteKaas(object? parameter)
        {
            return parameter is Kaas;
        }
    }
}
