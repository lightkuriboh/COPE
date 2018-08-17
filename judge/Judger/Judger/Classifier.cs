using System;

namespace Judger
{
	public class Classifier
	{
		public string Reconize_name_of_Problem (string s) {
			try {
				int Len = s.Length;
				string Name = "";
				for (int i = Len - 1; i >= 0; i--)
					if (s [i] == ']') {
						for (int j = i - 1; j >= 0; j--) {
							if (s [j] != '[')
								Name = s [j] + Name;
							else
								break;
						}
						break;
					}
				return Name;
			} finally {
			}
		}

		public string Reconize_User_ID (string s) {
			try {
				int Len = s.Length;
				string Name = "";
				int cnt = 0;
				for (int i = Len - 1; i >= 0; i--)
					if (s [i] == ']' && cnt == 1) {
						for (int j = i - 1; j >= 0; j--)
							if (s [j] != '[')
								Name = s [j] + Name;
							else
								return Name;
					} else 
						if (s [i] == ']')
							cnt++;
				return Name;
			} finally {
			}				
		}

		public string Reconize_ID_of_submission (string s) {
			try {
				int Len = s.Length;
				string Name = "";
				int cnt = 0;
				for (int i = Len - 1; i >= 0; i--)
					if (s [i] == ']' && cnt == 2) {
						for (int j = i - 1; j >= 0; j--)
							if (s [j] != '[')
								Name = s [j] + Name;
							else
								return Name;
					} else 
					if (s [i] == ']')
						cnt++;
				return Name;
			} finally {
			}
		}

		public string Reconize_Language(string s) {
			try {
				string ans = "";
				for (int i = s.Length - 1; i >= 0; i--) {
					ans = s [i] + ans;
					if (s [i] == '.')
						break;
				}
				return ans;
			} finally {
			}
		}

		public string Reconize_compiler (string extend) {
			try {
				switch (extend) {
				case ".cpp":
					return 
						"g++";
					
				case ".pas":
					return 
						"fpc";
				default:
					return "";
				}
			} finally {
			}
		}

		public string Reconize_compiler_command (string extend, string Destination, string alternative_user) {
			try {
				switch (extend) {
					case ".cpp":
						//return 
						//	"-std=c++14 "+ 
						//	"-o " + GlobalVariable.destination + "a " +
						//	GlobalVariable.destination + "a" + extend + "";
						return
							"-u " + alternative_user + 
							" g++ -std=c++14 " + 
							"-o " + Destination + "a " +
							Destination + "a" + extend + "";
					case ".pas":
						//return 
						//	" fpc " + 
						//	GlobalVariable.destination + "a" + extend;
						return 
							"-u " + alternative_user + 
							" fpc " + 
							Destination + "a" + extend;
					default:
						return "";
				}
			} finally {
			}
		}
	}
}

