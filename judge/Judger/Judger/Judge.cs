using System;
using System.IO;
using System.Threading;
using System.Diagnostics;
using System.Collections.Generic;

namespace Judger
{
	public class Judger
	{		
		


		private void init_info (string s, ref string extend, ref string problem_id, ref string submissionID, ref string username) {
			try {
				Classifier myClassifier = new Classifier ();
				problem_id = myClassifier.Reconize_name_of_Problem(s);
				submissionID = myClassifier.Reconize_ID_of_submission (s);
				extend = myClassifier.Reconize_Language (s);
				username = myClassifier.Reconize_User_ID (s);
			} catch (Exception) {
			} finally {
			}
		}

		private void get_problem_config (string Test_address, MySqlConnect mysql, ref double TimeLimit, ref int MemoryLimit) {
			try {
				string ID = "";
				for (int i = Test_address.Length - 1; i >= 0; i--)
					if (Test_address [i] != '/' && Test_address [i] != '/')
						ID = Test_address [i] + ID;
					else
						break;
				try {

					TimeLimit = Convert.ToDouble (mysql.ProcessQuery 
						("select", "problems_info", "TimeLimit","", "ID", ID)
					);

				} catch {

					TimeLimit = 1;

				}

				try {

					MemoryLimit = Convert.ToInt32 (mysql.ProcessQuery 
						("select", "problems_info", "MemoryLimit","", "ID", ID)
					);

				} catch {

					MemoryLimit = 256;

				}
			} finally {
				
			}
		}

		private void CreateResultFile (string submissionID) {
			try {
				string path_of_result = GlobalVariable.result_folder + submissionID + ".txt";
				try {
					if (!File.Exists(path_of_result)) File.Create(path_of_result).Dispose ();
					else 
						File.WriteAllText (path_of_result, "");				
				} catch (Exception ex) {
					Console.WriteLine ("Error creating result file: {0}", ex.Message);
				}
			} finally {
				
			}
		}

		void get_program_output (ref string str, string Destination) {
			try {
				StreamReader read;
				try {
					read = new StreamReader (Destination + "output.out");
					str = read.ReadToEnd ();
					//Console.WriteLine (" dasdadas {0}", str);
					read.Close ();
					read.Dispose ();
				} catch (Exception ex) {
					Console.WriteLine ("Error opening output file: {0}", ex.Message);
				}
			} finally {
				
			}
		}

		private bool Compare_with(ref string ProgramOutput, string Jury_output) {			
			try {
				StreamReader Jury = new StreamReader (Jury_output);
				string Jury_line = "";
				Jury_line = Jury.ReadToEnd ();				
				Jury.Close();
				Jury.Dispose ();
				string[] string_to_remove = new string [] {
					"\n",
					"\r",
					"  ",
				};
				//Console.WriteLine("Jury: {0}", Jury_line);
				//Console.WriteLine("Par: {0}", ProgramOutput);
				//Console.WriteLine ("--------------------------------");
				try {

					foreach (string s in string_to_remove) {
						Jury_line = Jury_line.Replace (s, " ".ToString());
						ProgramOutput = ProgramOutput.Replace (s, " ".ToString());
					}
					if (Jury_line.Length > 0 && Jury_line[Jury_line.Length - 1] != ' ') Jury_line += ' '.ToString();
					if (ProgramOutput.Length > 0 && ProgramOutput[ProgramOutput.Length - 1] != ' ') ProgramOutput += ' '.ToString();

					//foreach (char c in Jury_line) Console.WriteLine ("x{0}x", (int)c);
					//Console.WriteLine("----------------");
					//foreach (char c in ProgramOutput) Console.WriteLine ("x{0}x", (int)c);
					//Console.WriteLine ("{0} {1}", Jury_line.Length, ProgramOutput.Length);
				} catch (Exception ex) {
					Console.WriteLine ("ERROR removing spaces: {0}\n", ex.Message);
				}
				//Console.WriteLine ("Jury is \n{0}", Jury_line);
				//Console.WriteLine ("Parti is \n{0}", ProgramOutput);
				//Console.WriteLine("----------------");
				return (Jury_line == ProgramOutput);

			} finally {
				
			}
		}

		private void get_score (double score, bool successfully_compiled, string submissionID, bool TLE, bool RTE) {	
			try {
				StreamWriter res = new StreamWriter (GlobalVariable.result_folder + submissionID + ".txt", true);

				if (successfully_compiled) {

					res.WriteLine (score);

					if (TLE == true) 
						res.WriteLine ("Time Limit Exceeded");

					if (score < 100) {
						if (RTE == true) {
							res.WriteLine ("Runtime Error");
						} 
						else 
						if (TLE == false) {
							res.WriteLine ("Wrong Answer");
						}
					} else {
						res.WriteLine ("Accepted");
					}
					res.Close ();

				} else {

					string Error = "Compile error!";
					res.WriteLine (Error);				
					res.Close ();

				}
				res.Close ();
			} catch (Exception ex) {
				Console.WriteLine ("Error getting score: {0}", ex.Message);
			} finally {
				
			}
		}

		private void update_status (string status, string submissionID) {	
			try {
				StreamWriter res = new StreamWriter (GlobalVariable.result_folder + submissionID + ".txt", true);
				res.WriteLine (status);
				res.Close ();
				res.Dispose ();
			} catch (Exception ex) {
				Console.WriteLine ("Error updating status: {0}", ex.Message);
			} finally {
			}
		}			

		private void clear(string Destination) {
			try {				
				string[] myList = Directory.GetFiles (Destination, "*.inp", SearchOption.AllDirectories);
					foreach (string link in myList) {
						File.Delete (link);
					}
			} finally {
			}
		}

		private void Reset_Program(ref string PrgOutput, ref string PrgError, ref int PrgExitCode) {
			try {
				PrgOutput = "";
				PrgError = "";
				PrgExitCode = 0;
			} finally {
			}
		}

		private void update_highest_score (MySqlConnect mysql, double score, string problem_id, string username) {
			try {
				
				string current_score = 
					mysql.ProcessQuery ("select", "highest_score", problem_id, "", "User", username);
				
				current_score.ToLower ();

				if (current_score == "null" || Convert.ToDouble(current_score) < score) {
					mysql.ProcessQuery ("update", "highest_score", problem_id, Convert.ToString (score), "User", username);
				}
			} finally {
				
			}
		}


		private double Judge_With_Extend_Judging_Program (string path_to_program, string inpp, string outt, string Destination) {
			try {
				Process Extend_Judging_Program = new Process ();
				Extend_Judging_Program.StartInfo.FileName = path_to_program;
				Extend_Judging_Program.StartInfo.RedirectStandardInput = true;
				Extend_Judging_Program.StartInfo.RedirectStandardOutput = true;
				Extend_Judging_Program.StartInfo.UseShellExecute = false;
				Extend_Judging_Program.StartInfo.CreateNoWindow = true;
				Extend_Judging_Program.Start ();

				StreamWriter INPUT = Extend_Judging_Program.StandardInput;			
				INPUT.WriteLine (inpp);
				INPUT.WriteLine (outt);
				INPUT.WriteLine (Destination + "output.out");

				try {
					Extend_Judging_Program.WaitForExit (2000);	
					if (Extend_Judging_Program != null && Extend_Judging_Program.HasExited == false) {
						Extend_Judging_Program.Kill ();
						Extend_Judging_Program.Close ();
						Extend_Judging_Program.Dispose ();
						return 0.0;
					}

				} catch (Exception ex) {
					Console.WriteLine ("Error killing extend program: {0}", ex.Message);
				}

				double final = 0.0;
				string response = "0.0";

				try {
					StreamReader OUTPUT = Extend_Judging_Program.StandardOutput;	
					response = OUTPUT.ReadToEnd ();
				} catch (Exception ex) {
					Console.WriteLine ("Error getting Extend program output: {0}", ex.Message);
				}

				try {
					Extend_Judging_Program.Close ();
					Extend_Judging_Program.Dispose ();
				} catch (Exception ex) {
					Console.WriteLine ("Error closing extend judging program: {0}", ex.Message);
				}

				try {
					//Console.WriteLine("Judged with extend judger: {0}", response);
					final = Convert.ToDouble (response);

					return final;
				} catch {
					return 0.0;
				}

			} catch (Exception) {
				Console.WriteLine ("This program's coders are stupid extend program");
				return 0.0;
			} finally {
			}
		}


		public void Process(string s, string Destination, string alternative_user) {
			try {
				//------------------------------------------------------------
				//Stopwatch sw = Stopwatch.StartNew ();
				//------------------------------------------------------------

				Compile_and_Run Program = new Compile_and_Run ();

				string problem_id = "";
				string submissionID = "";
				string username = "";
				string extend = ".cpp";
				init_info (s, ref extend, ref problem_id, ref submissionID, ref username);
				string Test_address = GlobalVariable.Test_address_origin + problem_id;

				double TimeLimit = 1;
				int MemoryLimit = 256;
				bool TLE = false;
				bool RTE = false;

				MySqlConnect mysql = new MySqlConnect ();
				mysql.open_connection ();

				if (!Directory.Exists (Test_address)) {
					mysql.ProcessQuery ("update", "submission","Status", "'Test not found'","Submission_ID", submissionID);
					mysql.close_connection ();
					return;
				}

				string[] list_file_inp = {"*.inp", "*.INP", "*.Inp", "*.iNp", "*.inP", "*.INp", "*.InP", "*.iNP"};
				string[] list_file_out = {"*.out", "*.OUT", "*.Out", "*.oUt", "*.ouT", "*.OUt", "*.OuT", "*.oUT"};

				List <string> list_inp = new List <string>();
				List <string> list_out = new List <string>();

				foreach (string inp_extend in list_file_inp) {
					string [] listinp = Directory.GetFiles (Test_address, inp_extend, SearchOption.AllDirectories);
					foreach (string inp in listinp)
						list_inp.Add (inp);
				}

				foreach (string out_extend in list_file_out) {
					string [] listout = Directory.GetFiles (Test_address, out_extend, SearchOption.AllDirectories);
					foreach (string Out in listout)
						list_out.Add (Out);
				}
				list_inp.Sort();
				list_out.Sort();

				//string [] list_inp = Directory.GetFiles (Test_address, "*.inp", SearchOption.AllDirectories);
				//string [] list_out = Directory.GetFiles (Test_address, "*.out", SearchOption.AllDirectories);

				//Array.Sort (list_inp);
				//Array.Sort (list_out);


				string [] Exist_Extend_Judging_Program = Directory.GetFiles (Test_address, "*.exe");				
				bool ExtendJudge = 
					(!(Exist_Extend_Judging_Program == null || Exist_Extend_Judging_Program.Length == 0));
				if (ExtendJudge) {
					try {
						File.Copy (Exist_Extend_Judging_Program[0], Destination + "checker");
					} catch {
						ExtendJudge = false;
					}
				}
				//if (!(cfgFile == null || cfgFile.Length == 0)) 
				get_problem_config (Test_address, mysql, ref TimeLimit, ref MemoryLimit);



				int sz = list_inp.Count;
				if (sz != list_out.Count) {
					mysql.ProcessQuery ("update", "submission","Status", "'Test error'","Submission_ID", submissionID);
					return;
				}
							
				double score = 0.0;
				double score_for_each_test = 0;
				if (sz > 0) {
					score_for_each_test = 1.0 * 100 / sz;
				} else {
					mysql.ProcessQuery ("update", "submission","Status", "'Test error'","Submission_ID", submissionID);
					return;
				}

				//------------------------------------------------------------
				//sw.Stop ();
				//Console.WriteLine("Prepare cost: {0}", sw.ElapsedMilliseconds);
				//sw.Reset ();
				//sw.Start ();
				//------------------------------------------------------------

				try {
					Program = new Compile_and_Run ();
					Program.copy_participant_code (s, extend, Destination);
					Program.Compile_with (extend, Destination, alternative_user);
					//return;
				} catch (Exception ex) {
					Console.WriteLine("Error compiling: {0}", ex.Message);		
				}
				//------------------------------------------------------------
				//sw.Stop();
				//Console.WriteLine ("Compile cost: {0}", sw.ElapsedMilliseconds);
				//sw.Reset ();
				//------------------------------------------------------------
				clear(Destination);

				CreateResultFile (submissionID);

				//Console.WriteLine (Destination);

				for (int i = 0; i < sz; i++) {
					
					//-------------------------------------------------------------

					//Console.WriteLine ("Judged within: {0}ms", sw.ElapsedMilliseconds);
					//sw.Start ();
					//-------------------------------------------------------------

					Reset_Program (ref Program.Output, ref Program.Error, ref Program.ExitCode);

					string inpp = list_inp [i], outt = list_out [i];
					//Console.WriteLine ("{0}\n{1}", inpp, outt);

					update_status ("Judged test " + Convert.ToString (i + 1) + ":", submissionID);
					//Console.WriteLine ("Judging test: {0}", i + 1);

					mysql.ProcessQuery ("update", "submission","Status", "'Judging test " + (i + 1).ToString () + "'","Submission_ID", submissionID);

					//-------------------------------------------------------------
					//sw.Stop ();
					//Console.WriteLine ("reset cost: {0}", sw.ElapsedMilliseconds);
					//sw.Reset ();
					//sw.Start ();
					//-------------------------------------------------------------
					Stopwatch sw = Stopwatch.StartNew ();

					int RunningResult = 0;
					RunningResult = Program.Run_participant_code_with (inpp, TimeLimit, MemoryLimit, Destination, alternative_user);    

					sw.Stop();
					update_status ("Judged test " + Convert.ToString (i + 1) + " within: " + Convert.ToString(sw.ElapsedMilliseconds) + "ms", submissionID);
					//-------------------------------------------------------------
					//sw.Stop ();
					//Console.WriteLine ("Runcost: {0}", sw.ElapsedMilliseconds);
					//sw.Reset ();

					//-------------------------------------------------------------

					RTE |= (Program.ExitCode > 0);
					
					double Judging_Result = 0.0;

					if (RunningResult == 0) {						
						if (ExtendJudge) {
							
							//-------------------------------------------------------------
							//sw.Start ();
							//-------------------------------------------------------------

							try {
								Judging_Result = 
									Judge_With_Extend_Judging_Program (Destination + "checker", inpp, outt, Destination);
							} catch (Exception ex) {
								Console.WriteLine ("Error running extend: {0}", ex.Message);
							}

							//-------------------------------------------------------------
							//sw.Stop ();
							//Console.WriteLine ("Run extend cost: {0}", sw.ElapsedMilliseconds);
							//sw.Reset ();
							//-------------------------------------------------------------

						} else {
							
							get_program_output (ref Program.Output, Destination);
							 
							if (Compare_with (ref Program.Output, outt))
								Judging_Result = 1.0;
						}		
						
						update_status ("Score for this test: " + 
							Convert.ToString (score_for_each_test * Judging_Result), submissionID);
						
					} else 
					if (RunningResult == 1) {
						get_score (score, false, submissionID, TLE, RTE);
						Program.Delete_participant_file (extend, Destination);
						return;
					} else
					if (RunningResult == 2) {								
						Judging_Result = 0.0;
						update_status ("TLE", submissionID);
						TLE = true;
					}



					score += 1.0 * score_for_each_test * Judging_Result; 

					update_status ("Has exitcode: " + Convert.ToString(Program.ExitCode), submissionID);
				}	

				if (ExtendJudge) {
					try {
						File.Delete (Destination + "checker");
					} catch {
						ExtendJudge = false;
					}
				}

				//Console.WriteLine ("JUDGED");
				Program.Delete_participant_file (extend, Destination);

				get_score (score, true, submissionID, TLE, RTE);

				mysql.ProcessQuery ("update", "submission","Status", "'" + Convert.ToString (score) + "'","Submission_ID", submissionID);

				update_highest_score (mysql, score, problem_id, username);

				mysql.close_connection ();			

				string code_name = "";
				for (int i = s.Length - 1; i >= 0; i--)
					if (s [i] == '/') break;
					else 
						code_name = s [i] + code_name;
				//Console.WriteLine ("Judged {0} with result: {1}", code_name, score);

			} catch (Exception ex) {
				Console.WriteLine ("This program's coders are stupid - process: {0}", ex.Message);
			} finally {
				//Console.WriteLine ("Process done!");
			}
		}
	}
}

