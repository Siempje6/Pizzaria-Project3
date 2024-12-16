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
    internal class RouteViewModel : ObservableObject
    {
        private Route? _selectedRoute;
        private Route _route = new();

        public ObservableCollection<Route> FietsRoutes { get; } = [];

        public Route? SelectedRoute
        {
            get => _selectedRoute;
            set
            {
                if (_selectedRoute != value)
                {
                    _selectedRoute = value;
                    OnPropertyChanged();
                }
            }
        }

        public Route Route
        {
            get => _route;
            set
            {
                if (_route != value)
                {
                    _route = value;
                    OnPropertyChanged();
                }
            }
        }

        public RelayCommand AddTeamCommand { get; }
        public RelayCommand UpdateTeamCommand { get; }
        public RelayCommand DeleteTeamCommand { get; }

        private readonly UserMessage _userMessage;

#pragma warning disable CS8618 // Non-nullable field must contain a non-null value when exiting constructor. Consider adding the 'required' modifier or declaring as nullable.
        public RouteViewModel()
#pragma warning restore CS8618 // Non-nullable field must contain a non-null value when exiting constructor. Consider adding the 'required' modifier or declaring as nullable.
        {

        }
        public RouteViewModel(UserMessage userMessage)
        {
            using (F1DbContext db = new())
            {
                FietsRoutes = new(db.Fietsroutes.ToList());
            }
            AddTeamCommand = new RelayCommand(AddTeam);
            UpdateTeamCommand = new RelayCommand(UpdateTeam, CanUpdateTeam);
            DeleteTeamCommand = new RelayCommand(DeleteTeam, CanDeleteTeam);
            _userMessage = userMessage;
        }


        private void AddTeam(object? parameter)
        {
            try
            {

                FietsRoutes.Add(Route);

                using F1DbContext dbContext = new();
                Route.Id = 0;
                dbContext.Fietsroutes.Add(Route);
                dbContext.SaveChanges();

                Route = new Route();
            }
            catch (Exception ex)
            {
                _userMessage.Text = ex.InnerException == null ? ex.Message : ex.InnerException.Message;
            }

        }

        private void UpdateTeam(object? parameter)
        {
            try
            {
                if (SelectedRoute != null)
                {
                    SelectedRoute.Titel = Route.Titel;
                    SelectedRoute.Kilometer = Route.Kilometer;
                    SelectedRoute.Proviand = Route.Proviand;
                    SelectedRoute.BedragProviand = Route.BedragProviand;
                    SelectedRoute.StartDatum = Route.StartDatum;

                    using F1DbContext dbContext = new();
                    Route? databaseRoute = dbContext.Fietsroutes.FirstOrDefault(x => x.Id == SelectedRoute.Id);
                    if (databaseRoute != null)
                    {
                        databaseRoute.Titel = _selectedRoute.Titel;
                        databaseRoute.Kilometer = _selectedRoute.Kilometer;
                        databaseRoute.Proviand = _selectedRoute.Proviand;
                        databaseRoute.BedragProviand = _selectedRoute.BedragProviand;
                        databaseRoute.StartDatum = _selectedRoute.StartDatum;
                        dbContext.SaveChanges();
                    }

                    Route = new Route();
                }
            }
            catch (Exception ex)
            {
                _userMessage.Text = ex.InnerException == null ? ex.Message : ex.InnerException.Message;
            }
        }

        private void DeleteTeam(object? parameter)
        {
            try
            {
                if (parameter is Route teamToDelete)
                {
                    FietsRoutes.Remove(teamToDelete);

                    using F1DbContext dbContext = new();
                    Route? databaseRoute = dbContext.Fietsroutes.FirstOrDefault(x => x.Id == teamToDelete.Id);
                    if (databaseRoute != null)
                    {
                        dbContext.Fietsroutes.Remove(databaseRoute);
                        dbContext.SaveChanges();
                    }
                }
            }
            catch (Exception ex)
            {
                _userMessage.Text = ex.InnerException == null ? ex.Message : ex.InnerException.Message;
            }
        }

        private bool CanUpdateTeam(object? parameter)
        {
            return SelectedRoute != null && !string.IsNullOrWhiteSpace(Route.Titel);
        }

        private bool CanDeleteTeam(object? parameter)
        {
            return parameter is Route;
        }
    }
}
