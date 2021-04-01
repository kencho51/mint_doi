import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Scanner;

json = "";
Code = "";
DOI = "";
apiStatus ="";

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

} catch(Exception e) {
	e.printStackTrace();	
}