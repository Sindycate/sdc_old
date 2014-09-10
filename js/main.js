;
function inArray(value, array)
{
	for(var i = 0; i < array.length; i++)
	{
		if(array[i] == value)
			return true;
	}
	return false;
}

var expandArray = document.getElementsByClassName('expand');
var activePost = "active-post";
for (var i = 0; i < expandArray.length; i++)
{
	expandArray[i].onclick = function()
	{
		var post = this.previousElementSibling;
		var activePostsArray = document.getElementsByClassName(activePost);
		for (var j = 0; j < activePostsArray.length; j++)
		{
			if (activePostsArray[j] === post)
				continue;

			var readFull = activePostsArray[j].getElementsByClassName("read-full");
			readFull[0].classList.remove("hidden");

			activePostsArray[j].classList.remove(activePost);
		}

		if (inArray(activePost, post.classList))
		{
			post.classList.remove(activePost);

			var readFull = post.getElementsByClassName("read-full");
			readFull[0].classList.remove("hidden");
		}
		else
		{
			post.classList.add(activePost);

			var readFull = post.getElementsByClassName("read-full");
			readFull[0].classList.add("hidden");
		}
	};
}

// ******************************* Создаём конструктор класса

var Post = function(titleName, date, category, preview, article)
{
	this.titleName = titleName;
	this.date = date;
	this.category = category;
	this.preview = preview;
	this.article = article;
}

var request = new XMLHttpRequest();
request.open("GET", "data/0.json", false);
request.send(null);
var post = JSON.parse(request.responseText);
console.log(post);