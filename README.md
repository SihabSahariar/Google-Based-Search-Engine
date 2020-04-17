# Google-Based-Search-Engine
This is basic PHP code which usages google search engine in the backend to search data. 
Author: Sihab Sahariar
Author Company: Team Error
Author URL: github.com/sihabsahariar

# VARIABLES DESCRIPTION
1.$file is the name of this file

2.$q is the search term(s). We replace spaces with '+' to adhere to google query string

3.$num is the number of results to display per page

4.$start is the result that we start on. We use this to break up large result counts into pages

5.$page is for us to ensure proper values go to the $start variable.

6.$pages is the number of pages you want to offer the user to search.. at the bottom

7.$search is the value passed to actually perform the search. If $search != 1, the search field appears.

8.$ref is the url, filesize, date, etc. that google usually prints in green. This variable determines the color of that string.

