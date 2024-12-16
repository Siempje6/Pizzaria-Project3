using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using Project3.Model;
using Project3.View;

namespace Project3.Databases
{
    internal class F1DbContext : DbContext
    {

        public DbSet<Route> Fietsroutes { get; set; }
        public DbSet<Kaas> Kazen { get; set; }
        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            base.OnConfiguring(optionsBuilder);

            string connstr = ConfigurationManager.ConnectionStrings["F1ConnStrName"].ConnectionString;

            optionsBuilder.UseMySQL(connstr);
        }
    }
}
