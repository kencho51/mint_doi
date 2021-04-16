Formatted_Title = new ArrayList();
Formatted_Title.add("formatted title");

for (int i = 1; i < Title.size(); i++) {
	String title = Title.get(i);
	if (title.matches("NA")){
		DOI.add(title);
	} else {
		String item  = Title.get(i).replaceAll("\\n", "");
		item = item.replaceAll(" ", "%20");
		StringBuilder url	= new StringBuilder();
		url.append("https://api.crossref.org/works?query.bibliographic=");
		url.append(item);
		url.append("&");
		url.append("filter=issn:2047-217X");
		url.append("&rows=1");
		finalURL = url.toString();
		Formatted_Title.add(finalURL);
	}

}
