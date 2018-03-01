using System;
using MySql.Data.MySqlClient;
using System.Data;
namespace Judger
{
	public class MySqlConnect
	{				
		private MySqlConnection connection;

		public void open_connection() {
			try {
				string ConnectString = "Server=localhost;Database=infoDB;" +
										"User ID=root;Password=Matkhaula123;" +
										"Pooling=false";
				connection = new MySqlConnection (ConnectString);
				connection.Open ();
			} finally {
				
			}
		
		}

		public void close_connection () {
			try {
				connection.Close ();
				connection.Dispose ();
			} finally {
			}
		}

		private string update_query (string table, string field, string value, string Row, string infomation) {
			try {
				return "update " + table + " set " + field + " = " + value + 
						" Where " + Row + " = '" + infomation + "'";
			} catch {
				return "";
			}
		}

		private string process_update(string table, string field, string value, string Row, string infomation) {
			try {				
				string query = update_query (table, field, value, Row, infomation);
				//Console.WriteLine (query);
				MySqlCommand MyCommand = new MySqlCommand (query, connection);

				MySqlDataReader MyReader = MyCommand.ExecuteReader ();

				while (MyReader.Read ()) {
				}

				MyReader.Close ();
				MyReader.Dispose ();
				MyCommand.Dispose ();
			} catch (Exception ex) {
				Console.WriteLine ("Error updating database: {0}", ex.Message);
				return "";
			} finally {
			}

			return "";
		}

		private string select_query (string table, string field, string Row, string infomation) {			
			return "select " + field + " from " + table + " where " + Row + " = '" + infomation + "'";
		}

		private string process_select (string table, string field, string Row, string infomation) {
			try {				
				string query = select_query (table, field, Row, infomation);
				//Console.WriteLine(query);
				MySqlCommand MyCommand = new MySqlCommand (query, connection);

				MySqlDataReader MyReader = MyCommand.ExecuteReader ();

				while (MyReader.Read ()) {
					//string result = MyReader.GetString (0);
					string result = "";
					if (!MyReader.IsDBNull(0))
						result = MyReader.GetString (0);
					else
						result = "null";
					//Console.WriteLine (result);
					MyReader.Close ();
					MyReader.Dispose ();
					return result;
				}
				MyCommand.Dispose ();
			} catch (Exception ex) {
				Console.WriteLine ("Error getting value in database: {0}", ex.Message);
				return "";
			} finally {
			}
			return "";
		}

		public string ProcessQuery (string query_kind, string table, string field, string value, string Row, string infomation) {
			try {
				switch (query_kind) {
					case "update": 
						return process_update (table, field, value, Row, infomation);					
					case "select": 
						return process_select (table, field, Row, infomation);					
					default:
						return "";
				}
			} finally {
			}
		}
	}
}

