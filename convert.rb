require 'redcarpet'
renderer = Redcarpet::Render::HTML.new(with_toc_data: true)
markdown = Redcarpet::Markdown.new(renderer, autolink: true, tables: true, fenced_code_blocks: true)

puts markdown.render(File.read(ARGV[0]))