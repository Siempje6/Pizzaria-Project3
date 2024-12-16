﻿// <auto-generated />
using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Migrations;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;
using Project3.Databases;

#nullable disable

namespace Project3.Migrations
{
    [DbContext(typeof(F1DbContext))]
    [Migration("20241212101557_AddKazenTable")]
    partial class AddKazenTable
    {
        /// <inheritdoc />
        protected override void BuildTargetModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder
                .HasAnnotation("ProductVersion", "8.0.10")
                .HasAnnotation("Relational:MaxIdentifierLength", 64);

            modelBuilder.Entity("Project3.Model.Kaas", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<int>("Gewicht")
                        .HasColumnType("int");

                    b.Property<string>("Naam")
                        .IsRequired()
                        .HasMaxLength(255)
                        .HasColumnType("varchar(255)");

                    b.Property<decimal>("Prijs")
                        .HasColumnType("decimal(18,2)");

                    b.Property<DateTime>("Productiedatum")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Type")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.HasKey("Id");

                    b.ToTable("Kazen");
                });

            modelBuilder.Entity("Project3.Model.Route", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<int>("BedragProviand")
                        .HasColumnType("int");

                    b.Property<int>("Kilometer")
                        .HasColumnType("int");

                    b.Property<string>("Proviand")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<DateTime>("StartDatum")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Titel")
                        .IsRequired()
                        .HasMaxLength(255)
                        .HasColumnType("varchar(255)");

                    b.HasKey("Id");

                    b.ToTable("Fietsroutes");
                });
#pragma warning restore 612, 618
        }
    }
}
