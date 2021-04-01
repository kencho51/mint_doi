
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Scanner;
import org.json.*;

String json = "";
String Code = "";
String DOI = "";
String apiStatus ="";

String text = "";
try {
	URL url = new URL("http://api.crossref.org/works?query.bibliographic=Twelve%20years%20of%20SAMtools%20and%20BCFtools&filter=issn:2047-217X&rows=1");
	HttpURLConnection conn = (HttpURLConnection)url.openConnection();
	conn.setRequestMethod("GET");
	conn.setRequestProperty("Content-Type", "application/json");
	conn.connect();
	int responseCode = conn.getResponseCode();
	Code+=responseCode;
	if (responseCode !=200) {
		throw new RuntomeExeception("HttpResponseCode: " +responsecode);
	} else {
		Scanner sc = new Scanner(url.openStream());
		while (sc.hasNext()) {
			json+=sc.nextLine();
		}
		sc.close();
	}
	JSONObject obj = new JSONObject(json);
	apiStatus = obj.getString("status");
	JSONArray messageArr = obj.getJSONArray("message");

	for (int i = 0; i < messageArr.length(); i++) {

		DOI = messageArr.getString("total-results");
	}

} catch(Exception e) {
	e.printStackTrace();	
}

/
https://stackoverflow.com/questions/2591098/how-to-parse-json-in-java
https://www.geeksforgeeks.org/parse-json-java/
https://devqa.io/how-to-parse-json-in-java/
https://github.com/Corefinder89/SampleJavaCodes/blob/master/src/Dummy1.java
https://stackoverflow.com/questions/13269512/cant-access-getjsonarray-in-java
/