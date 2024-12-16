using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;
using Org.BouncyCastle.Asn1.Mozilla;
using Project3.Helpers;
using Project3.ViewModel;

namespace Project3.ViewModel
{
    internal class MainViewModel : ObservableObject
    {
        private object? _activeViewModel;
        public UserMessage UserMessage { get; }

        public object? ActiveViewModel
        {
            get => _activeViewModel;
            set
            {
                if (_activeViewModel != value)
                {
                    _activeViewModel = value;
                    OnPropertyChanged(nameof(ActiveViewModel));
                }
            }
        }

        public ICommand RouteCommand { get; }
        public ICommand ShowContactInfoCommand { get; }
        public ICommand KaasCommand { get; }

#pragma warning disable CS8618 // Non-nullable field must contain a non-null value when exiting constructor. Consider adding the 'required' modifier or declaring as nullable.
        public MainViewModel()
#pragma warning restore CS8618 // Non-nullable field must contain a non-null value when exiting constructor. Consider adding the 'required' modifier or declaring as nullable.
        {

        }
        public MainViewModel(UserMessage userMessage)
        {
            ActiveViewModel = new ContactInfoViewModel();
            UserMessage = userMessage;
            RouteCommand = new RelayCommand(ExecuteRouteCommand);
            ShowContactInfoCommand = new RelayCommand(ExecuteShowContactInfo);
            KaasCommand = new RelayCommand(ExecuteKaasCommand);
        }

        private void ExecuteRouteCommand(object? parameter)
        {
            ActiveViewModel = new RouteViewModel(UserMessage);
        }

        private void ExecuteShowContactInfo(object? parameter)
        {
            ActiveViewModel = new ContactInfoViewModel();
        }

        private void ExecuteKaasCommand(object? parameter)
        {
            ActiveViewModel = new KaasViewModel(UserMessage);
        }

    }
}
