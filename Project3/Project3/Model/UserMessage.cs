using System;
using System.ComponentModel;
using System.Windows.Threading;
using Project3.Helpers;

internal class UserMessage : ObservableObject
{
    private DispatcherTimer _timer;
    private string _text;

    public string Text
    {
        get => _text;
        set
        {
            if (_text != value)
            {
                _text = value;
                OnPropertyChanged(nameof(Text));
                _timer.Start();
            }
        }
    }

    public UserMessage()
    {
        _timer = new DispatcherTimer { Interval = TimeSpan.FromSeconds(5) };
        _timer.Tick += DispatcherTimer_Tick;
    }

    private void DispatcherTimer_Tick(object sender, EventArgs e)
    {
        Text = string.Empty;
        _timer.Stop();
    }
}
