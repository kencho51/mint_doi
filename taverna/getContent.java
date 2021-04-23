Content_to_append = new ArrayList();
Content_to_append.add("Content to append");

for (int i = 1; i < Reviewer_response.size(); i++) {
	String reviewer = Reviewer_response.get(i);
	String author = Reviewer_comment_to_author.get(i);
	String response = Response_to_reviewers.get(i);
	String questions = Custom_question.get(i);
	String content = author + "\n" + reviewer + "\n" + questions + "\n" + response;
	Content_to_append.add(content);
}