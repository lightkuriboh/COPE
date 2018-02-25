using System;
using System.IO;
using System.Threading;
using System.Diagnostics;
using System.Security.Permissions;
using System.Collections.Generic;

namespace Judger {
	
	public class Compile_and_Run {
		
		public string Error = "", Output = "";
		public int ExitCode = 0;

		public void copy_participant_code(string s, string extend, string Destination) {
			try {
				string SourceFile = s;
				string DestinationFile = Destination + "a" + extend;

				try {
					File.Copy (SourceFile, DestinationFile);	
				} catch (Exception ex) {
					Console.WriteLine ("Error copying participant's code: {0}", ex.Message);
				}
				try {
					File.Delete (SourceFile); // delete processed code
				} catch (Exception ex) {
					Console.WriteLine ("Error deleting participant's code: {0}", ex.Message);
				}
			} finally {
				
			}
		}

		public void Compile_with (string extend, string Destination) {
			try {
				Process Compile = new Process();
				Compile = new Process ();
				Compile.StartInfo.FileName = "/usr/bin/sudo";
				Classifier compiler = new Classifier ();
				//Compile.StartInfo.FileName = compiler.Reconize_compiler (extend);
				Compile.StartInfo.Arguments = compiler.Reconize_compiler_command (extend, Destination);
				Compile.StartInfo.WorkingDirectory = Destination;
				Compile.StartInfo.UseShellExecute = false;
				Compile.Start ();
				Compile.WaitForExit ();
				Compile.Close ();
				Compile.Dispose ();

				try {
					File.Delete (Destination + "a" + extend);
				}
				catch (Exception ex) {
					Console.WriteLine ("Error deleting participant's code: {0}", ex.Message);
				}
			} finally {
				
			}
		}

		private void Kill_all () {
			try {
				Process Killer = new Process ();
				Killer.StartInfo.FileName = "/usr/bin/sudo";
				Killer.StartInfo.Arguments = "pkill -u " + GlobalVariable.alternative_user;
				Killer.StartInfo.UseShellExecute = false;
				Killer.Start ();
				Killer.Close ();
				Killer.Dispose ();
			} finally {
			}
		}

		public int Run_participant_code_with (string test_address_input, double TimeLimit, int MemoryLimit, string Destination) {		
			try {
				Process Run = new Process ();
				Run = new Process ();
				Run.StartInfo.FileName = "/usr/bin/sudo";
				Run.StartInfo.Arguments = "-u " + GlobalVariable.alternative_user +
										" bash -c " + 
										"'" + 
										" ulimit -v " + Convert.ToString(MemoryLimit * 1024) + "; " + 
										Destination + "a" + 
										" < " + test_address_input + 
										" > " + Destination + "output.out" + 
										"'";				
				Run.StartInfo.WorkingDirectory = Destination;
				Run.StartInfo.UseShellExecute = false;
				Run.StartInfo.RedirectStandardInput = true;
				Run.StartInfo.RedirectStandardError = true;
				Run.StartInfo.RedirectStandardOutput = true;
				Run.Start ();
				Run.WaitForExit (Convert.ToInt32(TimeLimit * 1000.0));
				if (Run != null && Run.HasExited == false) {					
					Run.Kill();
					Run.Close ();
					Run.Dispose ();
					Kill_all ();
					return 2;
				} else {
					ExitCode = Run.ExitCode;
				}								
				Run.Close ();
				Run.Dispose ();
			}
			catch (Exception) {
				return 1;			
			} finally {				
				
			}

			return 0;
		}

		public void Delete_participant_file (string extend, string Destination) {				
			try {

				File.Delete (Destination + "a");
				File.Delete (Destination + "a" + extend);
				File.Delete (Destination + "output.out");
				File.Delete (Destination + "a.o");
			
			} catch (Exception ex) {
				Console.WriteLine ("Error deleting: {0}", ex.Message);
			}
		}
	}

}
