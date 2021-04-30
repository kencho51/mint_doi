fullName = new ArrayList();
fullName.add("Reviewer Name");

for (int i = 1; i < firstName.size(); i++){
	String first = firstName.get(i);
	String last = lastName.get(i);
	String full = first + " " + last;
	fullName.add(full);
}