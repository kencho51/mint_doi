import java.io.FileWriter;
import java.io.IOException;
import java.util.List;

csvWriter = new FileWriter("/Users/kencho/Desktop/test.csv");
for (int i = 0; i < title.size(); i++) {
	csvWriter.append(title.get(i));
	csvWriter.append(",");
	csvWriter.append(full_name.get(i));
	csvWriter.append(",");
	csvWriter.append(doi.get(i));
	csvWriter.append(",");
	csvWriter.append(content.get(i).replaceAll("\\n","").replaceAll(",","\\\\,"));
	csvWriter.append(",");
	csvWriter.append("\n");
}

csvWriter.flush();
csvWriter.close();