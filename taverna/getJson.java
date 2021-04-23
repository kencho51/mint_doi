import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Scanner;
import org.json.*;

json = "";
json += "Json Return";
Code = new ArrayList();
Code.add("Response Code");

for (int i = 1; i < Formatted_Title.size(); i++) {
	try {
		URL url = new URL(Formatted_Title.get(i));
		HttpURLConnection conn = (HttpURLConnection)url.openConnection();
		conn.setRequestMethod("GET");
		conn.setRequestProperty("Content-Type", "application/json");
		conn.connect();
		int responseCode = conn.getResponseCode();
		Code.add(responseCode);
		if (responseCode != 200) {
			throw new RuntimeException("HttpResponseCode: " +responsecode);
		} else {
			Scanner sc = new Scanner(url.openStream());
			while (sc.hasNext()) {
				json += sc.nextLine() + "\n";
			}
			sc.close();
		}
	} catch(Exception e) {
		e.printStackTrace();
	}

}

/
https://stackoverflow.com/questions/2591098/how-to-parse-json-in-java
https://www.geeksforgeeks.org/parse-json-java/
https://devqa.io/how-to-parse-json-in-java/
https://github.com/Corefinder89/SampleJavaCodes/blob/master/src/Dummy1.java
https://stackoverflow.com/questions/13269512/cant-access-getjsonarray-in-java
/


