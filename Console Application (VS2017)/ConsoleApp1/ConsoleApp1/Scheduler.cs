using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using OpenHardwareMonitor.Hardware;
using System.Threading;
using MySql.Data.MySqlClient;
using System.Configuration;

namespace ConsoleApp1
{
    class Scheduler
    {
        //CONFIG VARS, verbose 1 for output in console window, 0 for no. sqlon 1 for writing to database, 0 for no writing to database (for "dry run" testing of program). Lines of whitespace is the amount of blank lines outputted every update in the console
        static int verbose = 1;
        static int sqlon = 0;
        static int LinesOfWhitespace = 5;
        //change depending on computer
        //1 = Starsha
        //2 = Yoshimura
        //3 = mSERVER
        //4 = iSERVER
        //5 = pSERVER
        //6 = oSERVER
        //7 = sSERVER
        static int computerid = 1;

        static void Main(string[] args)
        {
            //setup openhardwaremonitor
            Computer c = new Computer
            {
                GPUEnabled = true,
                CPUEnabled = true,
                RAMEnabled = true,
                HDDEnabled = true,
                MainboardEnabled = true
            };
            c.Open();

            //init mysql connection
            string ConnectionString = ConfigurationSettings.AppSettings["ConnectionString"];
            MySqlConnection conn = null;

            try
            {
                conn = new MySqlConnection(ConnectionString);
                conn.Open();
                PrintOut("MySQL version : {0}"+ conn.ServerVersion);

            }
            catch (MySqlException ex)
            {
                PrintOut("Error: {0}"+ ex.ToString());

            }

            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;


            //value variables
            float GPUtemp = 0;
            float GPUclock = 0;
            float GPUload = 0;
            float CPUtemp = 40;
            float CPU1clock = 4015;
            float CPU2clock = 4015;
            float CPU3clock = 4015;
            float CPU4clock = 4015;
            float CPU5clock = 4015;
            float CPU6clock = 4015;
            float CPU7clock = 4015;
            float CPU8clock = 4015;
            float CPU9clock = 4015;
            float CPU10clock = 4015;
            float CPU11clock = 4015;
            float CPU12clock = 4015;
            float CPU13clock = 4015;
            float CPU14clock = 4015;
            float CPU15clock = 4015;
            float CPU16clock = 4015;
            float CPUload = 0;
            float RAMusage = 0;
            float HDDusage = 0;

            while (true)
            {

                foreach (var hardware in c.Hardware)
                {
                    hardware.Update();
                    //go over GPU
                    if (hardware.HardwareType == HardwareType.GpuAti)
                    {
                        hardware.Update();
                        foreach (var sensors in hardware.Sensors)
                        {
                            if (sensors.SensorType == SensorType.Temperature)
                            {
                                GPUtemp = sensors.Value.GetValueOrDefault();
                                Console.WriteLine("GPU temp:" + GPUtemp.ToString() + "C");
                            }
                            if (sensors.SensorType == SensorType.Clock)
                            {
                                if (sensors.Name == "GPU Core")
                                {
                                    GPUclock = sensors.Value.GetValueOrDefault();
                                    Console.WriteLine("GPU clock:" + GPUclock.ToString() + "MHz");

                                }
                            }
                            if (sensors.SensorType == SensorType.Load)
                            {
                                GPUload = sensors.Value.GetValueOrDefault();
                                Console.WriteLine("GPU load:" + GPUload.ToString() + "%");
                            }
                        }

                    }
                    //go over CPU
                    if (hardware.HardwareType == HardwareType.CPU)
                    {

                        hardware.Update();

                        //Routine for servers. All Intel CPUs, dual, no GPUs and dual CPU setups are common with no CPU over 4 cores, so values assined to those are assigned to the second CPU, etc. 
                        //They also have per-core temp sensors. Disregard all naming
                        if (hardware.Identifier.ToString() == "/intelcpu/0")
                        {

                            foreach (var sensors in hardware.Sensors)
                            {

                                //check temperature
                                if (sensors.SensorType == SensorType.Temperature)
                                {
                                    //go over each core individually, current intel CPUs in inventory don't have SMT and max out at 4 cores
                                    //for core 1
                                    if (sensors.Name == "CPU Core #1")
                                    {
                                        CPU5clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 1 temp:" + CPU5clock.ToString() + "C");

                                    }
                                    //for core 2
                                    if (sensors.Name == "CPU Core #2")
                                    {
                                        CPU6clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 2 temp:" + CPU6clock.ToString() + "C");

                                    }
                                    //for core 3
                                    if (sensors.Name == "CPU Core #3")
                                    {
                                        CPU7clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 3 temp:" + CPU7clock.ToString() + "C");

                                    }
                                    //for core 4
                                    if (sensors.Name == "CPU Core #4")
                                    {
                                        CPU8clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 4 temp:" + CPU8clock.ToString() + "C");

                                    }
                                }
                                //check temperature
                                if (sensors.SensorType == SensorType.Clock)
                                {
                                    if (sensors.Name != "Bus Speed")
                                    {
                                        //go over each core individually, current intel CPUs in inventory don't have SMT and max out at 4 cores
                                        //for core 1
                                        if (sensors.Name == "CPU Core #1")
                                        {
                                            CPU1clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 1 clock:" + CPU1clock.ToString() + "MHz");

                                        }
                                        //for core 2
                                        if (sensors.Name == "CPU Core #2")
                                        {
                                            CPU2clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 2 clock:" + CPU2clock.ToString() + "MHz");

                                        }
                                        //for core 3
                                        if (sensors.Name == "CPU Core #3")
                                        {
                                            CPU3clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 3 clock:" + CPU3clock.ToString() + "MHz");

                                        }
                                        //for core 4
                                        if (sensors.Name == "CPU Core #4")
                                        {
                                            CPU4clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 4 clock:" + CPU4clock.ToString() + "MHz");

                                        }

                                    }
                                }
                                //check load
                                if (sensors.SensorType == SensorType.Load)
                                {
                                    if (sensors.Name == "CPU Total")
                                    {
                                        CPUload = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU 1 load:" + CPUload.ToString() + "%");
                                    }
                                }
                            }



                        }
                         if (hardware.Identifier.ToString() == "/intelcpu/1")
                        {
                            foreach (var sensors in hardware.Sensors)
                            {

                                //check temperature
                                if (sensors.SensorType == SensorType.Temperature)
                                {
                                    //go over each core individually, current intel CPUs in inventory don't have SMT and max out at 4 cores
                                    //for core 1
                                    if (sensors.Name == "CPU Core #1")
                                    {
                                        CPU13clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 1 temp:" + CPU13clock.ToString() + "C");

                                    }
                                    //for core 2
                                    if (sensors.Name == "CPU Core #2")
                                    {
                                        CPU14clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 2 temp:" + CPU14clock.ToString() + "C");

                                    }
                                    //for core 3
                                    if (sensors.Name == "CPU Core #3")
                                    {
                                        CPU15clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 3 temp:" + CPU15clock.ToString() + "C");

                                    }
                                    //for core 4
                                    if (sensors.Name == "CPU Core #4")
                                    {
                                        CPU16clock = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU core 4 temp:" + CPU16clock.ToString() + "C");

                                    }
                                }
                                //check temperature
                                if (sensors.SensorType == SensorType.Clock)
                                {
                                    if (sensors.Name != "Bus Speed")
                                    {
                                        //go over each core individually, current intel CPUs in inventory don't have SMT and max out at 4 cores
                                        //for core 1
                                        if (sensors.Name == "CPU Core #1")
                                        {
                                            CPU9clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 1 clock:" + CPU9clock.ToString() + "MHz");

                                        }
                                        //for core 2
                                        if (sensors.Name == "CPU Core #2")
                                        {
                                            CPU10clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 2 clock:" + CPU10clock.ToString() + "MHz");

                                        }
                                        //for core 3
                                        if (sensors.Name == "CPU Core #3")
                                        {
                                            CPU11clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 3 clock:" + CPU11clock.ToString() + "MHz");

                                        }
                                        //for core 4
                                        if (sensors.Name == "CPU Core #4")
                                        {
                                            CPU12clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 4 clock:" + CPU12clock.ToString() + "MHz");

                                        }

                                    }
                                }
                                //check load
                                if (sensors.SensorType == SensorType.Load)
                                {
                                    if (sensors.Name == "CPU Total")
                                    {
                                        GPUload = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU 2 load:" + GPUload.ToString() + "%");
                                    }
                                }
                            }


                        }

                        //totally different routine for the AMD systems
                        if (hardware.Identifier.ToString() != "/intelcpu/1" && hardware.Identifier.ToString() != "/intelcpu/0")
                        {

                            foreach (var sensors in hardware.Sensors)
                            {

                                //check temperature
                                if (sensors.SensorType == SensorType.Temperature)
                                {
                                    CPUtemp = sensors.Value.GetValueOrDefault();
                                    PrintOut("CPU temp:" + CPUtemp.ToString() + "C");
                                }
                                //check temperature
                                if (sensors.SensorType == SensorType.Clock)
                                {
                                    if (sensors.Name != "Bus Speed")
                                    {
                                        //go over each core individually, needs to be 16 (including Starsha's SMTs)
                                        //for core 1
                                        if (sensors.Name == "CPU Core #1")
                                        {
                                            CPU1clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 1 clock:" + CPU1clock.ToString() + "MHz");

                                        }
                                        //for core 2
                                        if (sensors.Name == "CPU Core #2")
                                        {
                                            CPU2clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 2 clock:" + CPU2clock.ToString() + "MHz");

                                        }
                                        //for core 3
                                        if (sensors.Name == "CPU Core #3")
                                        {
                                            CPU3clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 3 clock:" + CPU3clock.ToString() + "MHz");

                                        }
                                        //for core 4
                                        if (sensors.Name == "CPU Core #4")
                                        {
                                            CPU4clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 4 clock:" + CPU4clock.ToString() + "MHz");

                                        }
                                        //for core 5
                                        if (sensors.Name == "CPU Core #5")
                                        {
                                            CPU5clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 5 clock:" + CPU5clock.ToString() + "MHz");

                                        }
                                        //for core 6
                                        if (sensors.Name == "CPU Core #6")
                                        {
                                            CPU6clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 6 clock:" + CPU6clock.ToString() + "MHz");

                                        }
                                        //for core 7
                                        if (sensors.Name == "CPU Core #7")
                                        {
                                            CPU7clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 7 clock:" + CPU7clock.ToString() + "MHz");

                                        }
                                        //for core 8
                                        if (sensors.Name == "CPU Core #8")
                                        {
                                            CPU8clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 8 clock:" + CPU8clock.ToString() + "MHz");

                                        }
                                        //for core 9
                                        if (sensors.Name == "CPU Core #9")
                                        {
                                            CPU9clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 9 clock:" + CPU9clock.ToString() + "MHz");

                                        }
                                        //for core 10
                                        if (sensors.Name == "CPU Core #10")
                                        {
                                            CPU10clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 10 clock:" + CPU10clock.ToString() + "MHz");

                                        }
                                        //for core 11
                                        if (sensors.Name == "CPU Core #11")
                                        {
                                            CPU11clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 11 clock:" + CPU11clock.ToString() + "MHz");

                                        }
                                        //for core 12
                                        if (sensors.Name == "CPU Core #12")
                                        {
                                            CPU12clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 12 clock:" + CPU12clock.ToString() + "MHz");

                                        }
                                        //for core 13
                                        if (sensors.Name == "CPU Core #13")
                                        {
                                            CPU13clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 13 clock:" + CPU13clock.ToString() + "MHz");

                                        }
                                        //for core 14
                                        if (sensors.Name == "CPU Core #14")
                                        {
                                            CPU14clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 14 clock:" + CPU14clock.ToString() + "MHz");

                                        }
                                        //for core 15
                                        if (sensors.Name == "CPU Core #15")
                                        {
                                            CPU15clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 15 clock:" + CPU15clock.ToString() + "MHz");

                                        }
                                        //for core 16
                                        if (sensors.Name == "CPU Core #16")
                                        {
                                            CPU16clock = sensors.Value.GetValueOrDefault();
                                            PrintOut("CPU core 16 clock:" + CPU16clock.ToString() + "MHz");

                                        }

                                    }
                                }
                                //check load
                                if (sensors.SensorType == SensorType.Load)
                                {
                                    if (sensors.Name == "CPU Total")
                                    {
                                        CPUload = sensors.Value.GetValueOrDefault();
                                        PrintOut("CPU load:" + CPUload.ToString() + "%");
                                    }
                                }
                            }
                        }

                    }
                    //go over RAM
                    if (hardware.HardwareType == HardwareType.RAM)
                    {

                        hardware.Update();
                        foreach (var sensors in hardware.Sensors)
                        {
                            //check load
                            if (sensors.SensorType == SensorType.Load)
                            {
                                RAMusage = sensors.Value.GetValueOrDefault();
                                PrintOut("RAM usage:" + RAMusage.ToString() + "%");

                            }
                        }

                    }
                    //go over HDD
                    if (hardware.HardwareType == HardwareType.HDD)
                    {

                        hardware.Update();
                        foreach (var sensors in hardware.Sensors)
                        {
                            //check load
                            if (sensors.SensorType == SensorType.Load)
                            {
                                HDDusage = sensors.Value.GetValueOrDefault();
                                PrintOut("SSD usage:" + HDDusage.ToString() + "%");

                            }
                        }

                    }
                }



                if (sqlon == 1)
                {
                    //prepare query to update records
                    cmd.CommandText = "UPDATE computers SET GPUtemp = " + GPUtemp + ", GPUclock = " + GPUclock + ", GPUload = " + GPUload + "," +
                        " CPUtemp = " + CPUtemp + ", " +
                        "CPU1clock = " + CPU1clock + ", " +
                        "CPU2clock = " + CPU2clock + ", " +
                        "CPU3clock = " + CPU3clock + ", " +
                        "CPU4clock = " + CPU4clock + ", " +
                        "CPU5clock = " + CPU5clock + ", " +
                        "CPU6clock = " + CPU6clock + ", " +
                        "CPU7clock = " + CPU7clock + ", " +
                        "CPU8clock = " + CPU8clock + ", " +
                        "CPU9clock = " + CPU9clock + ", " +
                        "CPU10clock = " + CPU10clock + ", " +
                        "CPU11clock = " + CPU11clock + ", " +
                        "CPU12clock = " + CPU12clock + ", " +
                        "CPU13clock = " + CPU13clock + ", " +
                        "CPU14clock = " + CPU14clock + ", " +
                        "CPU15clock = " + CPU15clock + ", " +
                        "CPU16clock = " + CPU16clock + ", " +
                        "CPUload = " + CPUload + ", RAMusage = " + RAMusage + ", HDDusage = " + HDDusage + "" +
                        ", updated = NOW()" +
                        " WHERE id = " + computerid + ";";
                    //prepare adapter to run query
                    cmd.Prepare();
                    cmd.ExecuteNonQuery();
                }



                //add whitespace
                for (int i = 0; i < LinesOfWhitespace; i++)
                {
                    PrintOut("");
                }

                //we'll only refresh every 10 seconds
                Thread.Sleep(10000);


            }
        }

        static void PrintOut(string text)
        {
            if (verbose == 1)
            {
                Console.WriteLine(text);
            }
        }


    }
}
