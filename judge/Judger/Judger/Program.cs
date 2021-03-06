using System;
using System.IO;
using System.Threading;
using System.Diagnostics;
using System.Collections.Generic;


namespace Judger
{	
	public class MainClass
	{
		public static void Shuffle (ref List<string> list) {
			try {
				int n = list.Count;
				Random rnd = new Random();
				while (n > 1) {
					int k = (rnd.Next(0, n) % n);
					n--;
					string value = list[k];
					list[k] = list[n];
					list[n] = value;
				}
			} finally {
			}
		}
		private static void Start_progress (string[] listFile, string RoomNumber, string alternative_user) {
			try {
				List <string> list_code = new List <string> ();

				foreach (string extend in listFile) {
					string[] list_code_part = Directory.GetFiles (GlobalVariable.source + RoomNumber, "*" + extend);
					foreach (string part in list_code_part) {
						list_code.Add (part);
					}
				}
					
				Shuffle (ref list_code);

				foreach (string s in list_code) {
					//Console.WriteLine ("Judging {0}", s);
					Judger New = new Judger ();

					Stopwatch sw = Stopwatch.StartNew ();

					New.Process (s, GlobalVariable.destination + RoomNumber, alternative_user);

					sw.Stop(); 
					//Console.WriteLine ("Judged within: {0}ms", sw.ElapsedMilliseconds);

					//Thread.Sleep (500);
					//Console.Clear ();
				}
			} finally {
			}
		}
		public static void Main (string[] args) {
			try {
				string[] listFile = {".pas", ".cpp", ".py", ".java"};
				Console.WriteLine ("Started!");
				Thread Judger1 = new Thread ( () => {
					while (true) {
						try {
							Start_progress (listFile, "room0/", "guest");
							Thread.Sleep (2000);
						} finally {
							
						}
					}
				});
				Thread Judger2 = new Thread ( () => {
					while (true) {
						try {
							Start_progress (listFile, "room1/", "guest1");
							Thread.Sleep (2000);
						} finally {

						}
					}
				});
				Thread Judger3 = new Thread ( () => {
					while (true) {
						try {
							Start_progress (listFile, "room2/", "guest2");
							Thread.Sleep (2000);
						} finally {

						}
					}
				});
				Judger1.Start ();
				Judger2.Start ();
				Judger3.Start ();


			} catch (Exception) {
				Console.WriteLine ("This program's coders are stupid - main");
			}
		}
	}
}