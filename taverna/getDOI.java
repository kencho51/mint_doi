import org.json.*;

DOI = new ArrayList();
DOI.add("DOI");
Status = new ArrayList();
Status.add("Status");

for (int j = 1; j < Json.size(); j++) {
    JSONObject obj = new JSONObject(Json.get(j));
    Status = obj.getString("status");
}