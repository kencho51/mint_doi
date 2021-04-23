// Process JSON data
import org.json.*;

String code = "";
String doi = "";
String apiStatus = "";
String text = "";
String message = "";
ArrayList items = new ArrayList();
String itemStr = "";

try {
  JSONObject obj = new JSONObject(crossref_json);
  apiStatus = obj.getString("status");
  //if (apiStatus.equals("ok")) {
    JSONObject messageObj = obj.getJSONObject("message");
    message = messageObj.toString();
    JSONArray itemsArr = messageObj.getJSONArray("items");
    for (int i = 0; i < itemsArr.length(); i++) {
      itemObj = itemsArr.getJSONObject(i);
      doi = itemObj.getString("DOI");
      itemStr = itemObj.toString();
      items.add(itemStr);
    }
  //}
} catch(Exception e) {
	e.printStackTrace();
}