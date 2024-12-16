using System.Windows.Controls;
using Project3.ViewModel;

namespace Project3.View
{
    public partial class ContactInfoView : UserControl
    {
        public ContactInfoView()
        {
            InitializeComponent();
            this.DataContext = new ContactInfoViewModel();
        }
    }
}
