
VIEWS CONTEXTUAL CONTAINS FILTER
================================

This is a simple plugin for Views that adds the option to contextually filter
a view with a simple LIKE statement (ie LIKE '%[your search string]%').

This is hardly an original work, it is almost entirely RdeBoer's
(https://drupal.org/user/404007) work, having started life as his "Views
Contextual Range Filter" https://drupal.org/project/contextual_range_filter
and then had large swaths of code deleted all willy nilly, and a handful
of variable names changed.

In fact, everything below this paragraph is his README, with the word
"range" changed to "contains."

You may use the OR ('+') and the negate operators. You negate by ticking the
"Exclude" box on the Views Contextual filter configuration panel, in the "More"
section.

Just like normal contextual filters, contextual contains filters may be set by
appending filter values to the URL. Alternatively, if you want to use a UI,
install the "Views Global Filter" module, http://drupal.org/project/global_filter.

To create a contextual contains filter, first create a plain contextual filter as
per normal. I.e. in the Views UI open the "Advanced" field set (upper right) and
click "add" next to the heading "Contextual filters". On the next panel select
the field or property that needs to be contextually filtered and "Apply". If you
want to take advantage of Views Global Filter, then the next panel is where you
press the "Provide default value" radio button to select the appropriate Global
Filter option. If you don't use a global filter you may pick any of the other
options. Fill out the remainder of the configuration panel, press "Apply" and
"Save" the view.

Now visit the Contextual Contains Filter configuration page,
admin/config/content/contextual_contains_filter, find your contextual filter name
and tick the box next to it, to turn it into a contextual  contains filter. Press
"Save configuration".

If you don't use the Views Global Filter widgets, then you set your contextual
filters by appending "arguments" to the view's URL.

Strings will be CASE-INSENSITIVE, unless your database defaults otherwise. In
your database's alphabet, numbers and special characters (@ # $ % etc.)
generally come before letters , e.g. "42nd Street" comes before "Fifth Avenue"
and also before "5th Avenue". The first printable ASCII character is the space
(%20). The last printable ASCII character is the tilde '~'. So to make sure
everything from "!Hello" and "@the Races" up to and including anything starting
with the letter r is returned use " --r~".

Multiple contextual filters (eg Title followed by Author) are fine and if you
ticked "Allow multiple searches" also, you can use the plus sign to OR filter
ranges like this:

  http://yoursite.com/yourthirdview/dark+black/john


ASCII AND UTF CHARACTER ORDERING
o http://en.wikipedia.org/wiki/UTF-8

