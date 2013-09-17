## Demo

See a working version [here](http://cn.asc.upenn.edu/?page_id=13).

## About

The SimplePeople plugin allows people connected to a site to be easily listed on a page. Information can be pulled from profiles or overidden in the shortcode.

## Usage

For each person you wish to list on the page, start with an enclosing tag like this:


    [simpleperson][/simpleperson]

But don't just leave it like that. Otherwise, nothing will show up on the page.

Each parameter that is available has the following format:


    key="value"


Note that the value (the bit on the right) mus be enclosed in the quotes. The key (the bit on the left) does not need quotes.

### Registered Users

If a person is a resgistered user of the your site, it's best to allow them to fill out their own information and upload their own user photo via their profile page. For each registered person you can add a shortcode to the page like this:


    [simpleperson username="someone"][/simpleperson]
    [simpleperson username="someoneElse"][/simpleperson]
    [simpleperson username="anotherSomeone"][/simpleperson]


Notice that all you need is their username. The plugin looks for information in the database and their profile based on the username.

### Unregistered users

If the person is not a registered user of your site (does not have a username), you can still add them to the page with a shortcode and some extra parameters. The following parameters are available to use:

  * #### photo_url

    * Description: This is the full url to wherever the person's picture is. It can be on your site or elsewhere. If you have installed and activated the [Easy Author Image][2] plugin, the SimplePeople plugin will look for that when querying the database.
    * Example value: `http://just.another.wordpress.site/wp-content/uploads/2013/08/picture.jpg`
    * Usage: `[simpleperson photo_url="http://31.media.tumblr.com/tumblr_m4h8jerwVx1qf46n3o1_400.jpg"][/simpleperson]`
  * #### tel_num

    * Description: The person's phone number. The plugin does not format this entry, so please format it correctly.
    * Example value: (123) 456-7890
    * Usage: [simpleperson tel_num="(123) 456-7890"][/simpleperson]
  * #### office_num

    * Description: The person's office location
    * Example value: 1322 Randall Hall
    * Usage: [simpleperson office_num="1322 Randall Hall"][/simpleperson]
  * #### email_addr

    * Description: The person's preferred email. The plugin does not check for correctly formatted addresses, so please ensure you've entered it correctly.
    * Example value: someone@someplace.com
    * Usage: [simpleperson email_addr="someone@someplace.com"][/simpleperson]
  * #### disp_name

    * Description: The person's preferred display name. This is the name that will appear on the "People" page.
    * Example value: Jean-Luc Picard
    * Usage: [simpleperson disp_name="Jean-Luc Picard"][/simpleperson]

Additionally, you can put content in between the tags so the person has a small bio. For example:


            [simpleperson]Thiis person is awesome.[/simpleperson]


Finally, note that if any parameters are used, they will override any information found in a user's profile. So if the user has an email under their profile, but they'd like to use a different one on the page, you can pass the "email_addr" parameter and override their default one.

   [1]: http://cn.asc.upenn.edu/?page_id=13
   [2]: http://wordpress.org/plugins/easy-author-image/ (Easy Author Image)

## Structure

This is the full DOM structure that is returned from the plugin:

    <div class="ppl">
        <div class="ppl-img">
            <img title="JP Obley" src="http://jpobley.com/wp-content/uploads/2013/09/JPFace-287x300.jpg" />
        </div>
        <div class="ppl-name">JP Obley</div>
        <div>Email: jpobley[at]gmail[dot]com</div>
        <div>Phone: 123-456-7890</div>
        <div>Office: 123 North Quad</div>
        <div class="ppl-bio">JP is a humanist with an indefatigable sense of wonder. He also makes a mean guacamole.</div>
    </div>

## Styling

Here are some basic CSS rules to get you started:

    .ppl {
        margin-bottom: 40px;
        clear: both;
    }
    .img-circle{
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }
    .ppl-bio {
        clear: both;
    }
    .ppl-name {
        font-weight: bold;
    }
    .ppl-img {
        float: left;
        margin-right: 20px;
        margin-bottom: 20px;
        width: 150px;
    }
    .ppl-img img {
        width: 100%;
        border: 1px solid #838383;
    }