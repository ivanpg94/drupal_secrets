<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @help_topics/responsive_image.style.html.twig */
class __TwigTemplate_79cabacd23e2692404f50d5586fa7cb9 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 10
        $context["media_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.media"));
        // line 11
        $context["image_style_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("image.style"));
        // line 12
        $context["breakpoint_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("breakpoint.overview"));
        // line 13
        ob_start(function () { return ''; });
        echo t("Responsive image styles", array());
        $context["styles_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 14
        $context["styles_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["styles_link_text"] ?? null), 14, $this->source), "entity.responsive_image_style.collection"));
        // line 15
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 16
        echo t("Configure a responsive image style, which can be used to display images at different sizes on different devices. See @media_topic for an overview of responsive image styles, and @breakpoint_overview_topic for an overview of breakpoints.", array("@media_topic" => ($context["media_topic"] ?? null), "@breakpoint_overview_topic" => ($context["breakpoint_overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 17
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 19
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Media</em> &gt; <em>@styles_link</em>.", array("@styles_link" => ($context["styles_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 20
        echo t("Click <em>Add responsive image style</em>.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Enter a descriptive <em>Label</em> for your style.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("Select a <em>Breakpoint group</em> from the groups defined by your installed themes and modules.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("Select a <em>Fallback image style</em> to use when none of the other styles apply. See @image_style_topic if you need to add a new style.", array("@image_style_topic" => ($context["image_style_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 24
        echo t("Click <em>Save</em>.", array());
        echo "</li>
  <li>";
        // line 25
        echo t("On the next page, locate the fieldsets for the breakpoints provided by the selected <em>Breakpoint group</em>.", array());
        echo "</li>
  <li>";
        // line 26
        echo t("For each breakpoint that you want to use, expand the corresponding fieldset. Select the <em>Select a single image style.</em> radio button under <em>Type</em> for the breakpoint, and select the <em>Image style</em> to use for images when that breakpoint is in effect. Repeat this step for the rest of the breakpoints you want to use.", array());
        echo "</li>
  <li>";
        // line 27
        echo t("Click <em>Save</em>", array());
        echo "</li>
  <li>";
        // line 28
        echo t("You can now use this responsive image style to format a field containing an image, in your layouts or traditional field displays. See related topics below for more information.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/responsive_image.style.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  101 => 28,  97 => 27,  93 => 26,  89 => 25,  85 => 24,  81 => 23,  77 => 22,  73 => 21,  69 => 20,  65 => 19,  60 => 17,  56 => 16,  51 => 15,  49 => 14,  45 => 13,  43 => 12,  41 => 11,  39 => 10,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/responsive_image.style.html.twig", "/var/www/html/web/core/modules/responsive_image/help_topics/responsive_image.style.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 10, "trans" => 13);
        static $filters = array("escape" => 16);
        static $functions = array("render_var" => 10, "help_topic_link" => 10, "help_route_link" => 14);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link', 'help_route_link']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
