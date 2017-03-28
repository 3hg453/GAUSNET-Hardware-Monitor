using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;
using System.Management;



namespace HardwareMonitor
{
    public static class Library
    {
        //Useful logfile code just in case
        public static void WriteToLog(string Message)
        {
            StreamWriter sw = null;
            try
            {
                sw = new StreamWriter(AppDomain.CurrentDomain.BaseDirectory + "\\logfile.txt", true);
                sw.WriteLine(DateTime.Now.ToString() + ":" + Message);
                sw.Flush();
                sw.Close();
            }
            catch { }

        }



    }
}
