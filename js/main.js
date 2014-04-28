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
		var post = this.parentNode;
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