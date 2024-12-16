using System.Configuration;
using System.Data;
using System.Windows;
using Project3.View;
using Project3.ViewModel;

namespace Project3
{
    /// <summary>
    /// Interaction logic for App.xaml
    /// </summary>
    public partial class App : Application
    {
        protected override void OnStartup(StartupEventArgs e)
        {
            base.OnStartup(e);
            UserMessage usermessage = new UserMessage();
            MainWindow = new MainView()
            {
                DataContext = new MainViewModel(usermessage)
            };
            MainWindow.Show();
        }
    }

}
