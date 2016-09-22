function montrer_cacher(laCase,leCalk,leCalk2)
{
    if (laCase.checked) //la case est cochée -> on montre le calque
    {
        document.getElementById(leCalk).style.visibility="visible";
				document.getElementById(leCalk2).style.visibility="visible";
    }
    else //la case n'est pas cochée -> on cache le calque
    {
        document.getElementById(leCalk).style.visibility="hidden";
				document.getElementById(leCalk2).style.visibility="hidden";
    }
} 
